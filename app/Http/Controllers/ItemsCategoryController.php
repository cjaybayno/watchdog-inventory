<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatables;
use App\Parameter;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\ParametersRepository as Parameters;

class ItemsCategoryController extends Controller
{
	/**
     * The parameters implementation.
     */
	protected $parameters;
	
	/**
     * Validation additional rules for UNIQUE
     */
	protected $validationRulesForUnique = 'NULL,id,param_group,items_category';
	
	/**
	* Determine Active Menu
	*/
    public $menuKey   = 'itemCategoryActiveMenu';
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
		return view('items/category.list')
				->nest('createFormModal', 'items/category.create')
				->nest('editFormModal', 'items/category.edit')
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
		])->where('param_group', 'items_category');
		
		return Datatables::of($parameters)
			->addColumn('action', function ($parameters) {
				return view('items/category/datatables.action', $parameters)->render();
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
			'name' 			=> 'required|unique:parameters,param_name,'.$this->validationRulesForUnique,
			'label'			=> 'required|unique:parameters,param_label,'.$this->validationRulesForUnique,
			'description'	=> 'required',
		]);
		
		$itemCategory = new Parameter;
		$itemCategory->param_name  = ucfirst($request->name);
		$itemCategory->param_label = ucfirst($request->label);
		$itemCategory->param_value = $request->description;
		$itemCategory->param_group = 'items_category';
		$itemCategory->save();
		
		return response()->json([
			'success' => true,
			'message' => 'Category Created'
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
		$itemCategory = Parameter::findOrFail($id);
		
		return response()->json([
			'id'		  => $itemCategory->id,
			'name' 		  => $itemCategory->param_name,
			'label' 	  => $itemCategory->param_label,
			'description' => $itemCategory->param_value,
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
		$itemCategory = Parameter::find($id);
		
        $this->validate($request, [
			'name' 			=> ($itemCategory->param_name  !== $request->name)
									? 'required|unique:parameters,param_name,'.$this->validationRulesForUnique : '',
			'label'			=> ($itemCategory->param_label !== $request->label)
									? 'required|unique:parameters,param_label,'.$this->validationRulesForUnique : '',
			'description'	=> 'required',
		]);
		
		$itemCategory->param_name  = ucfirst($request->name);
		$itemCategory->param_label = ucfirst($request->label);
		$itemCategory->param_value = $request->description;
		$itemCategory->param_group = 'items_category';
		$itemCategory->save();
		
		return response()->json([
			'success' => true,
			'message' => 'Item Category Updated'
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
	
		//Parameter::find($id)->delete();
		
		return response()->json([
			'success' => true,
			'message' => 'Category has been deleted'
		]);
    }
	
}
