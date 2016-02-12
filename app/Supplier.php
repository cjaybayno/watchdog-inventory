<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
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
		'payment_terms',
		'remarks'
	];
	
	/**
     * Paired a column to column 'name' as key
     *
     * @param	String	$defaultKeyValue
     * @param	String	$key
     * @return array
     */
	public static function pairedToName($parameter = [])
	{
		/* === default for key === */
		$key = (! empty($parameter['key'])) ? $parameter['key'] : 'id';
		
		/* === get items === */
		$paramRaw = Supplier::select(['id', 'name']);
		if (! empty($parameter['where']))
			$paramRaw = $paramRaw->where($parameter['where'])->get()->keyBy($key);
		else 
			$paramRaw = $paramRaw->get()->keyBy($key);
		
		$param = collect($paramRaw)
			->map(function($paramRaw) {
				return $paramRaw->name;
			})
			->toArray();
			
		/* === add default === */
		if (! empty($parameter['defaultKeyValue'])) $param[null] = $parameter['defaultKeyValue'];
		
		return $param;
	}
}
