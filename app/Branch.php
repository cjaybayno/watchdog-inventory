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
}
