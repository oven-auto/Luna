<?php

namespace App\Http\Controllers\Api\V1\Organization;

use App\Http\Controllers\Controller;
use App\Repositories\Organization\OrganizationRepository;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    public function __construct(
        private OrganizationRepository $repo,
    )
    {
        
    }



    public function index(Request $request)
    {
        $orgs = $this->repo->get($request->all());

        return response()->json([
            'data' => $orgs,
            'success' => 1,
        ]);
    }
}
