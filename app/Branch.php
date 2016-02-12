<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'name', 
		'code', 
		'street', 
		'brgy_town', 
		'province_city', 
		'zipcode', 
		'country',
		'contact_person',
		'contact_number',
		'fax_number',
		'email',
		'remarks'
	];
	
	/**
     * Paired a column to column 'name' as key
     *
     * @return array
     */
	public static function pairedToName($key = 'id')
	{
		$paramRaw = Branch::select(['name', $key])->get()->keyBy($key);
		
		$param = collect($paramRaw)
			->map(function($paramRaw) {
				return $paramRaw->name;
			});
			
		return $param;
	}
}
