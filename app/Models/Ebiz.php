<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \App\Traits\Uuids;

class Ebiz extends Model
{

    use Uuids;
    
    protected $connection = 'mysql1';
    protected $table = 'ebiz';
    
    public $incrementing = false;

}
