<?php

namespace App\Http\Controllers\Api\V1\Organization;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrganizationCoordRequest;
use App\Http\Requests\OrganizationFilterRequest;
use App\Repositories\Organization\OrganizationRepository;

class OrganizationController extends Controller
{
    public function __construct(
        private OrganizationRepository $repo,
    )
    {

    }



    public function index(OrganizationFilterRequest $request)
    {
        $orgs = $this->repo->get($request->all());

        return response()->json([
            'data' => $orgs,
            'success' => 1,
        ]);
    }



    public function show(int $id)
    {
        $org = $this->repo->getById($id);

        return response()->json([
            'data' => $org,
            'success' => 1,
        ]);
    }



    public function coord(OrganizationCoordRequest $request)
    {
        $orgs = $this->repo->getByCoord($request->all());

        return response()->json([
            'data' => $orgs,
            'success' => 1,
        ]);
    }
}
