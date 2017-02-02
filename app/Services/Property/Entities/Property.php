<?php

namespace App\Services\Property\Entities;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $table = 'tbl_property';

    protected $fillable = ['name', 'price', 'bedroom', 'bathroom', 'store', 'garage'];

}
