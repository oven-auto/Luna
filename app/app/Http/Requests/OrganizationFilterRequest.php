<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrganizationFilterRequest extends FormRequest
{
    /**
     * @OA\Schema(
     *  schema="OrganizationFilterRequest",
     *  @OA\Property(format="array", description="По Идентификаторам", property="ids", type="array", example="[1,2]", @OA\Items()),
     *  @OA\Property(format="array", description="По идентификаторам зданий", property="buildings", type="array", example="[1,2]", @OA\Items()),
     *  @OA\Property(format="array", description="По идентификаторам деятельности", property="activities", type="array", example="[1,2]", @OA\Items()),
     *  @OA\Property(format="string", description="По названию", property="name", type="string"),
     *  @OA\Property(format="integer", description="По родительской деятельности", property="activity_group", type="integer"),
     * )
     */
    public function authorize(): bool
    {
        return true;
    }



    public function rules(): array
    {
        return [
            'ids' => 'sometimes|array',
            'ids.*' => 'sometimes|integer',
            'buildings' => 'sometimes|array',
            'buildings.*'=> 'sometimes|integer',
            'activities' => 'sometimes|array',
            'activities.*'=> 'integer',
            'name' => 'sometimes|string',
            'activity_group' => 'sometimes|integer',
        ];
    }
}
