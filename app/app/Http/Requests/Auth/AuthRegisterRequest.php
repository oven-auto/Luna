<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *      required={"name", "email", "password"}
 * )
 */ 
class AuthRegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    
    /**
     * @OA\Property(format="string", description="Имя пользователя", property="name", type="string"),
     * @OA\Property(format="string", description="Email пользователя", property="email", type="string"),
     * @OA\Property(format="string", description="Пароль пользователя", property="password", type="string"),
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ];
    }
}
