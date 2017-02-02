<?php

namespace App\Services\Property\Contracts;
use App\Services\Repositories\BaseRepository;
use App\Services\Property\Entities\Property;

interface PropertyRepository extends BaseRepository
{
     /*
     return : array of Property listing 
     */
    public function getAllProperty();

    /*
     return : array of searched Property  
     */
    public function searchProperty($attributes);

}
