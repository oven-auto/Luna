<?php

use App\Http\Controllers\Api\V1\Organization\OrganizationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::get('organization', [OrganizationController::class, 'index']);
