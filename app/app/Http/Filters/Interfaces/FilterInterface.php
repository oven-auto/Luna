<?php


namespace App\Http\Filters\Interfaces;


use Illuminate\Database\Eloquent\Builder;

interface FilterInterface
{
    public function apply(Builder $builder);
}
