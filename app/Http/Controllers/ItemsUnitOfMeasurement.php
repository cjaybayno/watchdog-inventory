<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatables;
use App\Parameter;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\ParametersRepository as Parameters;

class ItemsUnitOfMeasurement extends Controller
{
	/**
     * The parameters implementation.
     */
	protected $parameters;
	
	/**
	* Determine Active Menu
	*/
    public $menuKey   = 'itemUomActiveMenu';
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
		return view('items/uom.list')
				->nest('createFormModal', 'items/uom.create')
				->nest('editFormModal', 'items/uom.edit')
				->with($this->menuKey, $this->menuValue);
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
	 
		$parameters = Parameter::select([
			'id',
			'param_name',
			'param_label',
			'param_value',
		])->where('param_group', 'uom');
		
		return Datatables::of($parameters)
			->addColumn('action', function ($parameters) {
				return view('items/uom/datatables.action', $parameters)->render();
			})
			->removeColumn('id')
			->make();
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
			'name' 			=> 'required|unique:parameters,param_name',
			'label'			=> 'required|unique:parameters,param_label',
			'description'	=> 'required',
		]);
		
		$itemUom = new Parameter;
		$itemUom->param_name  = ucfirst($request->name);
		$itemUom->param_label = $request->label;
		$itemUom->param_value = $request->description;
		$itemUom->param_group = 'uom';
		$itemUom->save();
		
		return response()->json([
			'success' => true,
			'message' => 'Unit Of Measurement Created'
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
		$itemUom = Parameter::findOrFail($id);
		
		return response()->json([
			'id'		  => $itemUom->id,
			'name' 		  => $itemUom->param_name,
			'label' 	  => $itemUom->param_label,
			'description' => $itemUom->param_value,
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
		$itemUom = Parameter::find($id);
		
        $this->validate($request, [
			'name' 			=> ($itemUom->param_name  !== $request->name)  ? 'required|unique:parameters,param_name' : '',
			'label'			=> ($itemUom->param_label !== $request->label) ? 'required|unique:parameters,param_label' : '',
			'description'	=> 'required',
		]);
		
		$itemUom->param_name  = ucfirst($request->name);
		$itemUom->param_label = $request->label;
		$itemUom->param_value = $request->description;
		$itemUom->param_group = 'uom';
		$itemUom->save();
		
		return response()->json([
			'success' => true,
			'message' => 'Unit Of Measurement Updated'
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
		if (! $request->ajax()) abort(404);
	
		Parameter::find($id)->delete();
		
		return response()->json([
			'success' => true,
			'message' => 'Category has been deleted'
		]);
    }
}
