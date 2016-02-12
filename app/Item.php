<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    /**
     * Paired a column to column 'name' as key
     *
     * @param	String	$defaultKeyValue
     * @param	String	$key
     * @return array
     */
	public static function paired($parameter = [])
	{
		/* === default for key === */
		$key = (! empty($parameter['key'])) ? $parameter['key'] : 'id';
		
		/* === get items === */
		$paramRaw = Item::select(['id', 'brand', 'name', 'measurement', 'uom']);
		if (! empty($parameter['where']))
			$paramRaw = $paramRaw->where($parameter['where'])->get()->keyBy($key);
		else 
			$paramRaw = $paramRaw->get()->keyBy($key);
		
		/* === reformat get items result === */
		$param = collect($paramRaw)
			->map(function($paramRaw) {
				return $paramRaw->brand.' '.$paramRaw->name.' ('.$paramRaw->measurement.$paramRaw->uom.')';
			})
			->toArray();
		
		/* === add default === */
		if (! empty($parameter['defaultKeyValue'])) $param[null] = $parameter['defaultKeyValue'];
		
		return $param;
	}
}
