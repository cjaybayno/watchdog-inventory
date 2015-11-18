<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Item;
use App\Branch;
use App\Purchase;
use App\VwBRanchAndItemPurchase as ViewPurchase;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
	/**
	* Determine Active Menu
	*/
    public $menuKey   = 'dashboardActiveMenu';
	public $menuValue = 'active';
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
		/* === get options items for select === */
		$items 	  	 = Item::all(['id', 'brand', 'name', 'measurement', 'uom']);
		$selectItems = [];
		foreach ($items as $item) {
			$selectItems[$item->id] = $item->brand.' '.$item->name.' ('.$item->measurement.$item->unit.')';
		}
		
		/* === get options branch for select === */
		$branches 		      = Branch::all(['id','name']);
		$selectBranches       = [];
		foreach ($branches as $branch) {
			$selectBranches[$branch->id] = $branch->name;
		}
		
		/* === set price selection === */
		$priceRange = [
			'ASC' 	=> 'Lowest Price',
			'DESC' 	=> 'Highest Price',
		];
		
		/* === default daterange === */
		$dateRange = date('m/d/Y', strtotime("-7 day")).' - '.date('m/d/Y');
		
        return view('dashboard')->with([
			'dateRange'		 => $dateRange,
			'priceRange' 	 => $priceRange,
			'selectItems' 	 => $selectItems,
			'selectedItem'	 => 1,
			'selectBranches' => $selectBranches,
			'selectedBranch' => 1,
			$this->menuKey 	 => $this->menuValue
		]);
    }
	
	/**
     * Show charts 1.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	public function postCharts1(Request $request) 
	{
		$dateRange  = explode('-', $request->input('dateRange'));
		$fromDate   = date('Y-m-d', strtotime($dateRange[0]));
		$toDate     = date('Y-m-d', strtotime($dateRange[1]));
		$item       = $request->input('item');
		$priceRange = $request->input('priceRange');
		
		$branches = Branch::select('id', 'name')->get();
		
		$setResponse = [];
		foreach ($branches as $branch) {
			$purchases = DB::select(DB::raw("SELECT * FROM (
					SELECT branch_id, item_id, price, date(created_at) as date_created
					FROM purchases 
					WHERE item_id = '$item'
					AND branch_id = '$branch->id'
					AND (date(created_at) BETWEEN '$fromDate' AND '$toDate')
					ORDER BY price $priceRange
				) as new GROUP BY date_created
			"));
			
			$dataSeries = [];
			foreach ($purchases as $purchase) {
				$dataSeries[] = [
					strtotime($purchase->date_created) * 1000, //format to javascript timestamp
					$purchase->price,
				];
			}
			
			$setResponse[] = [
				'name'  => $branch->name,
				'data'  => $dataSeries,
			];
		}
		
		return response()->json($setResponse);
	}
	
	/**
     * Show charts 2.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	public function postCharts2(Request $request) 
	{	
		/* === set date for query === */
		$date = date('Y-m-d', strtotime($request->input('date')));
		
		/* === get items and price from Purchases View table === */
		$purchases = ViewPurchase::select('item_id', 'item_brand', 'item_name', 'item_measurement', 'item_unit', 'price')
						->where('branch_id', $request->input('branch'))
						->where('created_at', 'like', "%$date%")
						->get();
						
		/* === get branch name from Branches table === */
		$branchName = Branch::select('name')->find($request->input('branch'))->name;
			
		$itemList = [];
		$itemPrice = [];
		foreach ($purchases as $purchase) {
			/* === set item list === */
			$itemList[] = $purchase->item_brand.' '.$purchase->item_name.' ('.$purchase->item_measurement.$purchase->item_unit.')';
			/* === set items price === */
			$itemPrice[] = $purchase->price;
		}
		
		return response()->json([
			'categories' => $itemList,
			'series' 	 => [[
				'name' => $branchName,
				'data' => $itemPrice
			]]
		]);
	}
}
