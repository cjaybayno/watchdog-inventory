<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatables;
use App\Supplier;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\AddressRepository as Address;
use App\Repositories\ParametersRepository as Parameters;

class SuppliersController extends Controller
{
	/**
     * The address implementation.
     */
	protected $address;
	
	/**
     * The parameters implementation.
     */
	protected $parameters;
	
	/**
	* Determine Active Menu
	*/
    public $menuKey   = 'supplierActiveMenu';
	public $menuValue = 'active';
	
	/**
     * Constructor enject repos.
     */
	public function __construct(Address $address, Parameters $parameters)
	{
		$this->address 	  = $address;
		$this->parameters = $parameters;
	}
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
		return view('suppliers.list')->with($this->menuKey, $this->menuValue);
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
	 
		$suppliers = Supplier::select([
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
		
		return Datatables::of($suppliers)
				->addColumn('action', function ($supplier) {
					return view('suppliers/datatables.action', $supplier)->render();
				})
				->addColumn('street', function ($supplier) {
					return view('suppliers/datatables.address', $supplier)->render();
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
		return view('suppliers.create')->with([
			'selectProvinceCity' => $this->address->provinceCity(),
			'selectPaymentTerms' => $this->parameters->paired(['param_group' => 'payment_term']),
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
		
		Supplier::create([
			'name' 			  => ucwords($request->name),
			'code'			  => strtoupper($request->code), 
			'street'		  => $request->street,
			'brgy_town'       => $request->brgy_town,
			'province_city'   => $request->province_city, 
			'zipcode'		  => $request->zipcode, 
			'country'		  => $request->country,
			'contact_person'  => ucwords($request->contact_person),
			'contact_number'  => $request->contact_number,
			'fax_number'      => $request->fax_number,
			'email'			  => $request->email,
			'payment_terms'	  => $request->payment_terms,
			'remarks'		  => $request->remarks,
		]);
		
		return response()->json([
			'success' => true,
			'message' => 'Supplier Created'
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
        return view('suppliers.show')->with([
			'supplier' 			 => Supplier::findOrFail($id), 
			'selectProvinceCity' => $this->address->provinceCity(),
			'selectPaymentTerms' => $this->parameters->paired(['param_group' => 'payment_term']),
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
        $supplier = Supplier::findOrFail($id);
		
		return view('suppliers.edit')->with([
			'supplier' 	   		 => $supplier, 
			'selectProvinceCity' => $this->address->provinceCity(),
			'selectBrgyTown' 	 => $this->address->brgyTown($supplier->province_city),
			'selectPaymentTerms' => $this->parameters->paired(['param_group' => 'payment_term']),
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
		$supplier = Supplier::find($id);
		
		$this->validate($request, [
				'code'		 	 => 'required|alpha_dash',
				'name' 			 => ($supplier->name !== $request->name) ? 'required|unique:suppliers' : '',
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
		
		$supplier->code			  = strtoupper($request->code); 
		$supplier->name			  = ucwords($request->name);
		$supplier->street		  = $request->street; 
		$supplier->brgy_town      = $request->brgy_town; 
		$supplier->province_city  = $request->province_city;
		$supplier->zipcode		  = $request->zipcode; 
		$supplier->country		  = $request->country;
		$supplier->contact_person = ucwords($request->contact_person);
		$supplier->contact_number = $request->contact_number;
		$supplier->fax_number     = $request->fax_number;
		$supplier->email		  = $request->email;
		$supplier->payment_terms  = $request->payment_terms;
		$supplier->remarks		  = $request->remarks;
		$supplier->save();
		
		return response()->json([
			'success' => true,
			'message' => 'Supplier Created'
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
		
		//Supplier::find($id)->delete();
		
		return response()->json([
			'success' => true,
			'message' => 'Supplier has been deleted'
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
