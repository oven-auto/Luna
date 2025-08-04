<?php

namespace App\Http\Controllers\Api\V1\Organization;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrganizationCoordRequest;
use App\Http\Requests\OrganizationFilterRequest;
use App\Http\Resources\BuildingCollection;
use App\Http\Resources\OrganizationCollection;
use App\Http\Resources\OrganizationItemResource;
use App\Repositories\Organization\OrganizationRepository;

class OrganizationController extends Controller
{
    public function __construct(
        private OrganizationRepository $repo,
    )
    {

    }



    /**
     * @OA\Get(
     *      path="/api/organizations",
     *      tags={"Организация"},
     *      summary="Получить список организаций, подходящих под условие фильтрации.",
     *      @OA\RequestBody(
     *         @OA\JsonContent(
     *              type="object",
     *              ref="#/components/schemas/OrganizationFilterRequest",
     *         )
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *          )
     *      ),
     * )
     */
    public function index(OrganizationFilterRequest $request)
    {
        $orgs = $this->repo->get($request->all());

        return new OrganizationCollection($orgs);
    }



        /**
     * @OA\Get(
     *      path="/api/organizations/{id}",
     *      tags={"Организация"},
     *      summary="Получить организацию по ее идентификатору.",
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *          )
     *      ),
     * )
     */
    public function show(int $id)
    {
        $org = $this->repo->getById($id);

        return new OrganizationItemResource($org);
    }


    /**
     * @OA\Get(
     *      path="/api/organizations/bycoords",
     *      tags={"Организация"},
     *      summary="Получить список зданий и организаций, находящихся в указаном квадрате, относительно выбранной точки.",
     *      @OA\RequestBody(
     *         @OA\JsonContent(
     *              type="object",
     *              ref="#/components/schemas/OrganizationCoordRequest",
     *         )
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *          )
     *      ),
     * )
     */
    public function coord(OrganizationCoordRequest $request)
    {
        $orgs = $this->repo->getByCoord($request->all());

        return new BuildingCollection($orgs);
    }
}
