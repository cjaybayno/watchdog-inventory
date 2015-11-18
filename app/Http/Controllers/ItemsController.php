<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatables;
use App\Item;
use App\Parameter;
use App\Http\Requests;
use App\MeasurementUnit as Unit;
use App\Http\Controllers\Controller;
use App\Repositories\ParametersRepository as Parameters;

class ItemsController extends Controller
{
	/**
     * The parameters implementation.
     */
	protected $parameters;
	
	/**
	* Determine Active Menu
	*/
    public $menuKey   = 'itemActiveMenu';
	public $menuValue = 'active';
	
	/**
     * Constructor enject repos.
     */
	public function __construct(Parameters $parameters)
	{
		$this->parameters = $parameters;
	}
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
         return view('items.list')->with($this->menuKey, $this->menuValue);
    }
	
	public function getTest()
	{
		$param =  Parameter::where('id', 10)->first();
		
		dd($param->param_label);
	}
	
	 /**
     * Return data for pagi	nation.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPaginate(Request $request)
    {
		if (! $request->ajax()) {
			abort(404);
		}
	 
		$items = Item::select([
			'id',
			'code',
			'brand',
			'name',
			'measurement',
			'uom',
			'category'
		]);
		
		return Datatables::of($items)
				->addColumn('action', function ($item) {
					return view('inventory/items/datatables.action', $item)->render();
				})
				->removeColumn('id')
				->make();
    }
	

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreate()
    {
		return view('items.create')->with([
			'selectCategory' => $this->parameters->paired(['param_group' => 'items_category'], 'param_label'),
			'selectUom' 	 => $this->parameters->paired(['param_group' => 'uom'], 'param_label'),
			$this->menuKey   => $this->menuValue
		]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postStore(Request $request)
    {
        $this->validate($request, [
				'code' 		  => 'required|alpha_dash',
				'brand'		  => 'required',
				'name'		  => 'required',
				'measurement' => 'required|numeric',
				'price'	  	  => 'required|numeric',
				'costing'	  => 'required|numeric',
				'image'		  => 'mimes:jpeg,png|between:1,1000'
			],
			[
				'numeric'  	 => 'The field must be a number',
				'alpha_dash' => 'Special characters is not allowed.',
				'between'	 => 'The Image must not be more than 1MB'
			]
		);
		
		$item = new Item;
		$item->code 	   	 = strtoupper($request->code);
		$item->brand 		 = ucwords($request->brand);
		$item->name 		 = ucwords($request->name);
		$item->measurement 	 = $request->measurement;
		$item->category 	 = $request->category;
		$item->current_price = $request->price;
		$item->costing_price = $request->costing;
		$item->uom 			 = $request->uom;
		$item->save();
		
		if ($request->hasFile('image')) {
			/* === upload images to server === */
			$item->image = $this->uploadImage($request->file('image'));
		} else {
			/* === get default image path === */
			$item->image = $this->defaultImage($item->category);
		}
		
		$item->save();
		
		return response()->json([
			'success' => true,
			'message' => 'Items Created'
		]);
    }
	
	/**
	* Upload Image to server and save to items table
	*
	* @param string	$image
	* return string 
	*/
	private function uploadImage($image)
	{	
		$fileName   = 'item'.time().'.'.$image->getClientOriginalExtension();
		$uploadPath = public_path('images\items');
		
		return $image->move($uploadPath, $fileName);
	}
	
	/**
	* Default Images based in category
	*
	* @param string	$category
	* return string 
	*/
	private function defaultImage($category)
	{
		return public_path('images/items/default/'.strtolower($this->category).'-logo.jpg');
	}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getShow($id)
    {
        return view('inventory/items.show')->with([
			'item' 	   => Item::findOrFail($id), 
			$this->menuKey => $this->menuValue
		]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getEdit($id)
    {
		/* === get options items for select === */
		$units 	  	  = Unit::all(['name', 'symbol']);
		$selectMunits = [];
		$selectMunits[null] = 'Select Items'; // set default selected
		foreach ($units as $unit) {
			$selectMunits[$unit->symbol] = "$unit->name ($unit->symbol)";
		}
		
        return view('inventory/items.edit')->with([
			'item' 	   	   => Item::findOrFail($id), 
			'selectMunits' => $selectMunits,
			$this->menuKey => $this->menuValue
		]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function postUpdate(Request $request, $id)
    {	
        $this->validate($request, [
				'brand' 		=> 'required|max:50',
				'name'  		=> 'required|max:50',
				'measurement'  	=> 'required|numeric',
				'unit'  		=> 'required',
			],
			[
				'required' => 'This field is required',
				'numeric'  => 'The field must be a number'
			]
		);
		
		$item = Item::find($id);
		$item->brand 		= $request->brand;
		$item->name 		= $request->name;
		$item->measurement 	= $request->measurement;
		$item->unit 		= $request->unit;
		$item->save();
		
		return redirect('inventory/items/show/'.$id)
					->with('status', 'User successfully Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getDelete(Request $request, $id)
    {	
		if (! $request->ajax()) {
			abort(404);
		}
	
		// $item = Item::find($id);
		// $item->delete();
		
		return response()->json([
			'success' => true,
			'message' => 'Item has been deleted'
		]);
    }
}
