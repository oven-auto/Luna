<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *      required={"email", "password"}
 * )
 */ 
class AuthLoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    
    /**
     * @OA\Property(format="string", description="Email пользователя", property="email", type="string"),
     * @OA\Property(format="string", description="Пароль пользователя", property="password", type="string"),
     */
    public function rules(): array
    {
        return [
            'email' => 'required',
            'password' => 'required',
        ];
    }
}
