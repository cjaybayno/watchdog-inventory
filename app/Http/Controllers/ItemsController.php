<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatables;
use App\Item;
use App\Supplier;
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
			'category',
			'current_price',
			'supplier_id',
		]);
		
		return Datatables::of($items)
				->addColumn('measurement', function ($item) {
					return $item->measurement.' '.$item->uom;					
				})
				->addColumn('supplier', function ($item) {
					$supplier = Supplier::find($item->supplier_id);
					if ($supplier !== null) return $supplier->name;						
				})
				->addColumn('Price', function ($item) {
					return $item->current_price;
				})
				->addColumn('action', function ($item) {
					return view('items/datatables.action', $item)->render();
				})
				->removeColumn('id')
				->removeColumn('supplier_id')
				->removeColumn('uom')
				->removeColumn('current_price')
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
			'selectSupplier' => Supplier::pairedToName('No Supplier'),
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
		$item->supplier_id 	 = ($request->supplier != NULL) ? $request->supplier : NULL ;;
		$item->current_price = $request->price;
		$item->costing_price = $request->costing;
		$item->uom 			 = $request->uom;
		
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
			'message' => 'Items Created',
			'itemId'  => $item->id
		]);
    }
	
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getShow($id)
    {
        return view('items.show')->with([
			'item' 	   		 => Item::findOrFail($id), 
			'selectCategory' => $this->parameters->paired(['param_group' => 'items_category'], 'param_label'),
			'selectUom' 	 => $this->parameters->paired(['param_group' => 'uom'], 'param_label'),
			'selectSupplier' => Supplier::pairedToName('No Supplier'),
			$this->menuKey   => $this->menuValue
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
       return view('items.edit')->with([
			'item' 	   		 => Item::findOrFail($id), 
			'selectCategory' => $this->parameters->paired(['param_group' => 'items_category'], 'param_label'),
			'selectUom' 	 => $this->parameters->paired(['param_group' => 'uom'], 'param_label'),
			'selectSupplier' => Supplier::pairedToName('No Supplier'),
			$this->menuKey   => $this->menuValue
		]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function postUpdate(Request $request, $id)
    {
		$item = Item::find($id);
		
		$this->validate($request, [
				'code' 		  => ($item->code  !== $request->code)
									? 'required|alpha_dash|unique:items,code' : '',
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
		
		$item->code 	   	 = strtoupper($request->code);
		$item->brand 		 = ucwords($request->brand);
		$item->name 		 = ucwords($request->name);
		$item->measurement 	 = $request->measurement;
		$item->category 	 = $request->category;
		$item->supplier_id 	 = ($request->supplier != NULL) ? $request->supplier : NULL ;
		$item->current_price = $request->price;
		$item->costing_price = $request->costing;
		$item->uom 			 = $request->uom;
		
		if ($request->hasFile('image')) {
			/* === delete images in server === */
			$this->deleteImage($item->image);
			
			/* === upload images to server === */
			$item->image = $this->uploadImage($request->file('image'));
		}
		
		$item->save();
		
       return response()->json([
			'success' => true,
			'message' => 'Item Updated',
			'itemId'  => $item->id
		]);
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
		
		Item::find($id)->delete();
		
		return response()->json([
			'success' => true,
			'message' => 'Item has been deleted'
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
		$fileName  = 'item'.time().'.'.$image->getClientOriginalExtension();
		$imagePath = 'images\items';
		
		/* === move image to items image path === */
		$image->move(public_path($imagePath), $fileName);
		
		return url('public/images/items/'.$fileName);
	}
	
	/**
	* Delete Image to server
	*
	* @param string	$imagePath
	* return boolean
	*/
	public function deleteImage($imagePath)
	{
		$explodeUrl = explode('/', $imagePath);
		$indexCount = count($explodeUrl) - 1;
		$imageName  = public_path('images\items/'.$explodeUrl[$indexCount]);
		
		if (file_exists($imageName)) {
			/* === delete images === */
			return unlink($imageName);
		} else {
			return false;
		}
		
	}
	
	/**
	* Default Images based in category
	*
	* @param string	$category
	* return string 
	*/
	private function defaultImage($category)
	{
		$itemCategory   = Parameter::where('param_label', $category)->first();
		$itemParamValue = json_decode($itemCategory['param_value'], true);
		
		if (! empty($itemParamValue['image'])) {
			/* === get image url to param_value === */
			return url('public/'.$itemParamValue['image']);
		} else {
			/* === get image default url === */
			return url('public/images/items/default/default-logo.jpg');
		}
	}
}
