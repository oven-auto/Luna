<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrganizationActivity extends Model
{
    public $timestamps = false;

    protected $fillable = ['organization_id', 'activity_id'];
}
