<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

Class AuthService
{
    public function create(array $data) : User
    {
        $user = User::create($data);

        return $user;
    }



    public function getToken(User $user) : string
    {
        $token = $user->createToken('MyAppToken')->plainTextToken;

        return $token;
    }



    public function login(array $data) : User
    {
        if (!Auth::attempt($data))
            throw new \Exception('Пароль или email не верны.');//Конечно тут можно импользовать кастомный класс исключения

        $user = Auth::user();

        return $user;
    }
}
