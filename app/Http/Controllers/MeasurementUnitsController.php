<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatables;
use App\MeasurementUnit as Unit;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class MeasurementUnitsController extends Controller
{
	/**
	* Determine Active Menu
	*/
    public $menuKey   = 'MunitActiveMenu';
	public $menuValue = 'active';
	
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
	{
		return view('inventory.list')->with($this->menuKey, $this->menuValue);
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
	 
		$units = Unit::select([
			'id',
			'name',
			'symbol',
			'category'
		]);
		
		return Datatables::of($units)
				->addColumn('action', function ($units) {
					return view('inventory/munits/datatables.action', $units)->render();
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
        return view('inventory/munits.create')->with($this->menuKey, $this->menuValue);
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
				'name' 		=> 'required',
				'symbol'  	=> 'required',
				'category'  => 'required',
			],
			['required' => 'This field is required']
		);
		
		$unit = new Unit;
		$unit->name 	= $request->name;
		$unit->symbol 	= $request->symbol;
		$unit->category	= $request->category;
		$unit->save();
		
		return redirect()
				->route('munits.show', $unit->id)
				->with('status', 'Measurement Unit created!');
    }

	/**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getShow($id)
    {
        return view('inventory/munits.show')->with([
			'munits' 	   => Unit::findOrFail($id), 
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
        return view('inventory/munits.edit')->with([
			'munits' 	   => Unit::findOrFail($id), 
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
				'name' 		=> 'required',
				'symbol'  	=> 'required',
				'category'  => 'required',
			],
			['required' => 'This field is required']
		);
		
		$unit = Unit::find($id);
		$unit->name 	= $request->name;
		$unit->symbol 	= $request->symbol;
		$unit->category	= $request->category;
		$unit->save();
		
		return redirect()
				->route('munits.show', $unit->id)
				->with('status', 'Measurement Unit Successfully updated!');
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
	
		$item = Unit::find($id);
		$item->delete();
		
		return response()->json([
			'success' => true,
			'message' => 'Measurement units has been deleted'
		]);
    }
}
