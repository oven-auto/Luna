<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Malhal\Geographical\Geographical;

class Building extends Model
{
    use Geographical;

    public $timestamps = false;

    protected $fillable = ['address', 'coordx', 'coordy'];

    const LATITUDE  = 'coordx';

    const LONGITUDE = 'coordy';

    protected static $kilometers = true;



    public function organizations()
    {
        return $this->hasMany(\App\Models\Organization::class, 'building_id','id');
    }
}
