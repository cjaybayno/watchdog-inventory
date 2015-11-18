<?php 

namespace App\Repositories;

use App\Parameter;

class ParametersRepository
{
	
	public function get($where = [], $select = ['*'])
	{
		if (! empty($where)) {
			return Parameter::select($select)->where($where)->get();
		} else {
			return Parameter::all($select);
		}
	}
	
	/**
     * Get key/value pair of parameters
     *
     * @return array
     */
	public function paired($where, $key = 'id')
	{
		$paramRaw = Parameter::where($where)->get()->keyBy($key);
		
		$param = collect($paramRaw)
			->map(function($paramRaw) {
				return $paramRaw->param_label;
			});
			
		return $param;
	}
}