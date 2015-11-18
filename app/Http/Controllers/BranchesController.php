<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatables;
use App\Branch;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\AddressRepository as Address;

class BranchesController extends Controller
{
	/**
     * The address implementation.
     */
	protected $address;
	
	/**
	* Determine Active Menu
	*/
    public $menuKey   = 'branchActiveMenu';
	public $menuValue = 'active';
	
	/**
     * Constructor enject repos.
     */
	public function __construct(Address $address)
	{
		$this->address = $address;
	}
	
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
		return view('branches.list')->with($this->menuKey, $this->menuValue);
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
	 
		$branches = Branch::select([
			'id',
			'code',
			'name',
			'street',
			'brgy_town',
			'province_city',
			'zipcode',
			'country',
			'contact_person',
			'contact_number',
			
		]);
		
		return Datatables::of($branches)
				->addColumn('action', function ($branch) {
					return view('branches/datatables.action', $branch)->render();
				})
				->addColumn('street', function ($branch){
					return view('branches/datatables.address', $branch)->render();
				})
				->removeColumn('id')
				->removeColumn('brgy_town')
				->removeColumn('province_city')
				->removeColumn('zipcode')
				->removeColumn('country')
				->make();
    }
	
	/**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreate()
    {
		return view('branches.create')->with([
			'selectProvinceCity' => $this->address->provinceCity(),
			$this->menuKey 		 => $this->menuValue
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
			'code'		 	 => 'required|alpha_dash',
			'name' 			 => 'required',
			'street'		 => 'required',
			'brgy_town'		 => 'required',
			'province_city'	 => 'required',
			'zipcode'	 	 => 'required',
			'country'	 	 => 'required',
			'contact_person' => 'required',
			'contact_number' => 'required|regex:/^(\d+-?)+\d+$/',
			'fax_number'	 => 'regex:/^(\d+-?)+\d+$/',
			'email'			 => 'email',
		],
		[
			'alpha_dash' => 'Special characters is not allowed.',
		]);
		
		$branch = Branch::create([
			'code'			  => strtoupper($request->code), 
			'name' 			  => ucwords($request->name), 
			'street'		  => $request->street, 
			'brgy_town'       => $request->brgy_town, 
			'province_city'   => $request->province_city, 
			'zipcode'		  => $request->zipcode, 
			'country'		  => $request->country,
			'contact_person'  => ucwords($request->contact_person),
			'contact_number'  => $request->contact_number,
			'fax_number'      => $request->fax_number,
			'email'			  => $request->email,
			'remarks'		  => $request->remarks,
		]);
		
		return response()->json([
			'success' => true,
			'message' => 'Branch Created'
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
		return view('branches.show')->with([
			'branch' 			 => Branch::findOrFail($id), 
			'selectProvinceCity' => $this->address->provinceCity(),
			$this->menuKey 		 => $this->menuValue
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
		$branch = Branch::findOrFail($id);
		
		return view('branches.edit')->with([
			'branch' 	   		 => $branch, 
			'selectProvinceCity' => $this->address->provinceCity(),
			'selectBrgyTown' 	 => $this->address->brgyTown($branch->province_city),
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
		$branch = Branch::find($id);
		
		$this->validate($request, [
			'code'		 	 => 'required|alpha_dash',
			'name' 			 => ($branch->name !== $request->name) ? 'required|unique:branches' : '',
			'street'		 => 'required',
			'brgy_town'		 => 'required',
			'province_city'	 => 'required',
			'zipcode'	 	 => 'required',
			'country'	 	 => 'required',
			'contact_person' => 'required',
			'contact_number' => 'required|regex:/^(\d+-?)+\d+$/',
			'fax_number'	 => 'regex:/^(\d+-?)+\d+$/',
			'email'			 => 'email',
		],
		[
			'alpha_dash' => 'Special characters is not allowed.',
		]);
		
		$branch->code 			= strtoupper($request->code);
		$branch->name 	 		= ucwords($request->name);
		$branch->street 		= $request->street;
		$branch->brgy_town 		= $request->brgy_town;
		$branch->province_city  = $request->province_city;
		$branch->zipcode	    = $request->zipcode;
		$branch->country	    = $request->country;
		$branch->contact_person = ucwords($request->contact_person);
		$branch->contact_number = $request->contact_number;
		$branch->fax_number	    = $request->fax_number;
		$branch->email		    = $request->email;
		$branch->save();
		
		return response()->json([
			'success' => true,
			'message' => 'Branch Updated'
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
	
		// $branch = Branch::find($id);
		// $branch->delete();
		
		return response()->json([
			'success' => true,
			'message' => 'Branch has been deleted'
		]);
    }
	
	/**
     * Get list of Barangay/Town.
     *
     * @return JSON of location in zipcodes
     */
	public function getBrgyTown($provinceCity)
	{
		return response()->json($this->address->brgyTown($provinceCity));
	}
	
	/**
     * Get Zipcode of Barangay Town.
     *
     * @return JSON of zipcodes
     */
	public function getZipcode($brgyTown)
	{
		return response()->json($this->address->zipCode($brgyTown));
	}
}
