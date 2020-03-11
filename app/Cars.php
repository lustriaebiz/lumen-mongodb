<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Cars extends Eloquent 
{

    protected $connection = 'mongodb';
    protected $collection = 'cars';
    
    protected $fillable = [
        'company', 'name','price'
    ];
}