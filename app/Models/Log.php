<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Log extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'log';

    protected $primaryKey = '_id';
    
    protected $fillable = [
        'method', 'path','headers', 'request', 'response'
    ];

    protected $hidden = ['updated_at', 'created_at'];
}
