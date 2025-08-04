<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrganizationCoordRequest extends FormRequest
{
        /**
     * @OA\Schema(
     *  schema="OrganizationCoordRequest",
     *  @OA\Property(format="string", description="Ширина", property="coordx", type="string"),
     *  @OA\Property(format="string", description="Долгота", property="coordy", type="string"),
     *  @OA\Property(format="string", description="Радиус", property="radius", type="string"),
     * )
     */
    public function authorize(): bool
    {
        return true;
    }




    public function rules(): array
    {
        return [
            'coordx' => 'required|decimal:1,6',
            'coordy' => 'required|decimal:1,6',
            'radius' => 'required|numeric',
        ];
    }
}
