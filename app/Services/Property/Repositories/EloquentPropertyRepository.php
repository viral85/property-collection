<?php

namespace App\Services\Property\Repositories;

use DB;
use Auth;
use Config;
use App\Services\Property\Contracts\PropertyRepository;
use App\Services\Repositories\Eloquent\EloquentBaseRepository;
use App\Services\Property\Entities\Property;

class EloquentPropertyRepository extends EloquentBaseRepository implements PropertyRepository 
{
	/*
    * Get All Property
    */
	public function getAllProperty()
    {
        $properties = DB::table(config::get('databaseconstants.TBL_PROPERTY'))
                    ->get();
        return $properties;
    }
    /*
    * Search property with parameters 
    */
    public function searchProperty($attributes)
    {
    	$query = DB::table(config::get('databaseconstants.TBL_PROPERTY') ." AS tbl_property");
    	
    	$query->select('tbl_property.id');

    	if (isset($attributes['name']) && $attributes['name'] != "") {
            $query->whereRaw('lower(tbl_property.name) LIKE lower(?)', ['%'.$attributes['name'].'%']);
        }

        if (isset($attributes['bedroom']) && is_numeric($attributes['bedroom']) && $attributes['bedroom'] > 0) {
            $query->where('tbl_property.bedroom', '=', $attributes['bedroom']);
        }

        if (isset($attributes['bathroom']) && is_numeric($attributes['bathroom']) && $attributes['bathroom'] > 0) {
            $query->where('tbl_property.bathroom', '=', $attributes['bathroom']);
        }

        if (isset($attributes['store']) && is_numeric($attributes['store']) && $attributes['store'] > 0) {
            $query->where('tbl_property.store', '=', $attributes['store']);
        }

        if (isset($attributes['garage']) && is_numeric($attributes['garage']) && $attributes['garage'] > 0) {
            $query->where('tbl_property.garage', '=', $attributes['garage']);
        }

        $min_value = (isset($attributes['min_price']) && is_numeric($attributes['min_price']) && $attributes['min_price'] > 0) ? $attributes['min_price'] : "";
        $max_value = (isset($attributes['max_price']) && is_numeric($attributes['max_price']) && $attributes['max_price'] > 0) ? $attributes['max_price'] : "";

        if ($min_value != "" && $max_value == "") {
            $query->where('tbl_property.price', '>=', $attributes['min_price']);
        }
        else if($max_value != "" && $min_value == "")
        {
        	$query->where('tbl_property.price', '<=', $attributes['max_price']);
        }
        else if($max_value != "" && $min_value != "")
        {
        	$query->whereBetween('tbl_property.price', [$attributes['min_price'], $attributes['max_price']]);
        }
        else{

        }
        
        $propertyIds = $query->distinct()->lists('id');

        $property = Property::whereIn('id', $propertyIds)->get(['name', 'price', 'bedroom', 'bathroom', 'store', 'garage']);
        
        return $property;
    }
    
}