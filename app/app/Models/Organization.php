<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use Filterable;

    public $timestamps = false;

    protected $fillable = ['name','building_id'];



    public function building()
    {
        return $this->hasOne(\App\Models\Building::class, 'id', 'building_id');
    }



    public function phones()
    {
        return $this->hasMany(\App\Models\OrganizationPhone::class, 'organization_id', 'id');
    }



    public function activities()
    {
        return $this->belongsToMany(\App\Models\Activity::class, 'organization_activities', 'organization_id', 'activity_id', 'id', 'id');
    }
}
