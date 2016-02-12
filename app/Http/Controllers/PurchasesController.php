<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatables;
use App\Item;
use App\Branch;
use App\Supplier;
use App\Purchase;
use App\PurchaseItem;
use App\PurchaseOrder;
use App\Http\Requests;
use App\VwBranchAndItemPurchase;
use App\Http\Controllers\Controller;

class PurchasesController extends Controller
{
	/**
	* Determine Active Menu
	*/
    public $menuKey   = 'purchaseActiveMenu';
	public $menuValue = 'active';
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
       return view('purchase.list')->with($this->menuKey, $this->menuValue);
    }
	
	 /**
     * Return data for pagination.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPaginate(Request $request)
    {
		if (! $request->ajax()) {
			abort(404);
		}
	 
		$purchaseOrder = PurchaseOrder::select([
			'id',
			'invoice_number',
			'supplier_id',
			'total',
			'status',
			'created_at',
			'expected_date'
		]);
		
		return Datatables::of($purchaseOrder)
					->addColumn('id', '{{ str_pad($id, 5, 0, STR_PAD_LEFT) }}')
					->addColumn('supplier_id', function ($purchaseOrder) {
						return Supplier::select()->find($purchaseOrder->supplier_id)->name;
					})
					->addColumn('total', '{{ number_format($total, 2) }}')
					->addColumn('status', function ($purchaseOrder) {
						return view('purchase/datatables.status', $purchaseOrder)->render();
					})
					->addColumn('created_at', '{{ date("Y/m/d h:i:s a", strtotime($created_at)) }}')
					->addColumn('expected_date', function($purchaseOrder){
						if (empty($purchaseOrder->expected_date))
							return 'no date yet';
						else 
							return date("Y/m/d h:i:s a", strtotime($purchaseOrder->expected_date));
					})
					->addColumn('action', function ($purchaseOrder) {
						return view('purchase/datatables.action', $purchaseOrder)->render();
					})
					->make();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreate()
    {
		return view('purchase.create')->with([
			'selectBranches' => Branch::pairedToName(),
			'selectSupplier' => Supplier::pairedToName(['defaultKeyValue' => 'Select Supplier']),
			$this->menuKey 	 => $this->menuValue
		]);
    }
	
	/**
     * Get Items of Supplier.
     *
     * @return JSON
     */
	public function getItemsOfSupplier($supplierId) {
		$selectItems = Item::select([
			'id',
			'brand',
			'name',
			'measurement',
			'uom',
			'current_price'
		])
		->where([
			'supplier_id' => $supplierId]
		)
		->get();
		
		return response()->json($selectItems);
	}
	
	/**
     * Get Items Details
     *
     * @return JSON
     */
	public function getItemPrice($itemId) {
		return response()->json(Item::select('current_price')->find($itemId));
	}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postStore(Request $request)
    {
		/* === validate quantity request === */
		if ($this->validateQuantityRequest($request->quantity)) {
			/* === save to purchase_orders table === */
			$purchaseOrder = new PurchaseOrder();
			$purchaseOrder->branch_id 	= $request->branch;
			$purchaseOrder->supplier_id = $request->supplier;
			$purchaseOrder->total	    = $request->total_raw;
			$purchaseOrder->remarks	    = $request->remarks;
			$purchaseOrder->status	    = 'PENDING';
			$purchaseOrder->save();
			
			/* === set data for purchase_items === */
			$quantityCount 		= count($request->quantity);
			$purchaseItemsArray = [];
			for ($i = 0; $i < $quantityCount; $i++) {
				if ($request->quantity[$i] != 0 OR $request->quantity[$i] != '') {
					/* === include only the qunatity that is not 0.00 and '' in value === */
					$purchaseItemsArray[] = [
						'purchase_order_number' => $purchaseOrder->id,
						'item_id' 				=> $request->item[$i],
						'quantity' 				=> $request->quantity[$i],
						'price' 				=> $request->price[$i],
						'discount' 				=> $request->discount[$i],
						'subtotal' 				=> $request->subtotal[$i],
					];
				}
			}
			
			/* === save to purchase_items table === */
			PurchaseItem::insert($purchaseItemsArray);
			
			return response()->json([
				'success' => true,
				'message' => 'PO Created',
				'debug'	  => $purchaseItemsArray,
			]);
		} else {
			return response()->json([
				'success' => false,
				'message' => 'Must Have Atleast 1 Item',
			]);
		}
		
    }
	
	/**
	 * Validate Quantity Request
	 * count quantity with value == ''
	 * if any return false, else true
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  String	$request
	 * @param  String	$rules
	 * @return array
	 */
	private function validateQuantityRequest($value)
	{
		$flag  = 0;
		$count = count($value);
		for ($i = 0; $i < $count; $i++) {
			if ($value[$i] == '' OR $value[$i] == 0) $flag++;
		}
		
		return ($flag === $count) ? false : true;
	}
		
	/**
	 * Set an iteration post parameter data.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  String	$request
	 * @param  String	$rules
	 * @return array
	 */
	public function setIteratePostParam($request, $inputName, $rules = 'required')
	{
		$inputCount = count($request->input($inputName));
        if ($inputCount >= 0) { 
			$inputArray = [];
			for($i = 0; $i < $inputCount; $i++) {
				$inputArray[$inputName.'.'.$i] = $rules;
			}
		} else {
			return [];
		}
			
		return $inputArray;
	}
	
	 /**
     * Set Array for Batch insert in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
	public function setBatchInsertArray($request)
	{
		$branch = $request->input('branch_purchase');
		$items  = $request->input('item_purchase');
		$qty    = $request->input('quantity');
		$price  = $request->input('price');
		
		$newArray = [];
		for ($i = 0; $i < count($items); $i++) {
			$newArray[] = [
				'branch_id'	=> $branch,
				'item_id' 	=> $items[$i],
				'price' 	=> $price[$i],
				'quantity' 	=> $qty[$i],
				'total' 	=> ($qty[$i] * $price[$i]) ,
				'created_at'=> date("Y-m-d H:i:s")
			];
		}
		
		return $newArray;
	}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
