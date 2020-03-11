<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Cars extends Eloquent 
{

    protected $connection = 'mongodb';
    protected $collection = 'cars';

    protected $primaryKey = '_id';
    
    protected $fillable = [
        'company', 'name','price'
    ];

    protected $hidden = ['updated_at', 'created_at'];
}