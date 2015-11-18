<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatables;
use App\Branch;
use App\VwBranchAndItemPurchase;
use App\Item;
use App\Purchase;
use App\Http\Requests;
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
    public function index()
    {
        return view('purchase.list')->with($this->menuKey, $this->menuValue);
    }
	
	 /**
     * Return data for pagination.
     *
     * @return \Illuminate\Http\Response
     */
    public function paginate(Request $request)
    {
		if (! $request->ajax()) {
			abort(404);
		}
	 
		$purchase = VwBranchAndItemPurchase::select([
			'id',
			'branch',
			'item_name',
			'item_brand',
			'item_measurement',
			'item_unit',
			'price',
			'quantity',
			'total',
			'created_at'
		]);
		
		return Datatables::of($purchase)
					->addColumn('item_name', function ($purchase) {
						return view('purchase/datatables.item', $purchase)->render();
					})
					->removeColumn('item_brand')
					->removeColumn('item_measurement')
					->removeColumn('item_unit')
					->addColumn('created_at', '{{ date("F jS, Y h:i:s a", strtotime($created_at)) }}')
					->make();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		/* === get options items for select === */
		$items 	  	 = Item::all(['id', 'brand', 'name', 'measurement', 'unit']);
		$selectItems = [];
		$selectItems[null] = 'Select Items'; // set default selected
		foreach ($items as $item) {
			$selectItems[$item->id] = $item->brand.' '.$item->name.' ('.$item->measurement.$item->unit.')';
		}
		
		/* === get options branch for select === */
		$branches 		      = Branch::all(['id','name']);
		$selectBranches       = [];
		$selectBranches[null] = 'Select Branch'; // set default selected
		foreach ($branches as $branch) {
			$selectBranches[$branch->id] = $branch->name;
		}
		
		return view('purchase.create')->with([
			'selectItems' 	 => $selectItems,
			'selectBranches' => $selectBranches,
			$this->menuKey 	 => $this->menuValue
		]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$rules = array_merge(
			['branch_purchase' => 'required'],
			$this->setIteratePostParam($request, 'item_purchase'),
			$this->setIteratePostParam($request, 'quantity','required|numeric'),
			$this->setIteratePostParam($request, 'price', 'required|numeric')
		);
	
		$this->validate($request, $rules, [
			'required' => ' This is required',
			'numeric'  => ' Must be numeric',
		]);
		
		Purchase::insert($this->setBatchInsertArray($request));
		
		return response()->json([
			'success' => true,
			'message' => 'Purchase Save!',
		]);
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
			for($i = 0; $i < $inputCount; $i++ ) {
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
