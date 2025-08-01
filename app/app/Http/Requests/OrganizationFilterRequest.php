<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrganizationFilterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
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
