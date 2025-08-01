<?php

namespace App\Repositories\Organization;

use App\Http\Filters\OrganizationFilter;
use App\Models\Organization;

Class OrganizationRepository
{
    public function getById(int $id) : Organization
    {
        $org = Organization::findOrFail($id);

        return $org;
    }



    public function get(array $data, $paginate = 20)
    {
        $query = Organization::select('organizations.*');

        $filter = app()->make(OrganizationFilter::class, ['queryParams' => array_filter($data)]);
        
        $query->filter($filter);

        $orgs = $query->simplePaginate($paginate);

        return $orgs;
    }
}