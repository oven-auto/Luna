<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthLoginRequest;
use App\Http\Requests\Auth\AuthRegisterRequest;
use App\Services\Auth\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(
        private AuthService $repo
    )
    {

    }



    /**
     * @OA\Post(
     *      path="/api/auth/register",
     *      tags={"Авторизация/Аутентификация"},
     *      summary="Регистрация пользователя",
     *      @OA\RequestBody(
     *         @OA\JsonContent(
     *              type="object",
     *              ref="#/components/schemas/AuthRegisterRequest",
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
    public function register(AuthRegisterRequest $request)
    {
        $user = $this->repo->create(data: $request->validated());

        $token = $this->repo->getToken(user: $user);

        return response()->json([
            'success' => 1,
            'user' => $user,
            'token' => $token,
        ]);
    }



    /**
     * @OA\Post(
     *      path="/api/auth/login",
     *      tags={"Авторизация/Аутентификация"},
     *      summary="Логин пользователя",
     *      @OA\RequestBody(
     *         @OA\JsonContent(
     *              type="object",
     *              ref="#/components/schemas/AuthLoginRequest",
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
    public function login(AuthLoginRequest $request)
    {
        $user = $this->repo->login(data: $request->validated());

        $token = $this->repo->getToken(user: $user);

        return response()->json([
            'success' => 1,
            'user' => $user,
            'token' => $token,
        ]);
    }



    /**
     * @OA\Post(
     *      path="/api/auth/logout",
     *      tags={"Авторизация/Аутентификация"},
     *      summary="Выход пользователя",
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *          )
     *      ),
     * )
     */
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'success' => 1,
        ]);
    }
}
