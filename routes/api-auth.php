<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;


Route::any('/', function(){
    return ["api" => env('APP_NAME')];
});

Route::get('/up', function(){

    return [
        'message' => 'System is up and running.',
        'time-unix'=> time(),
        'time-carbon' => now(),
        'time-format' => now()->format('Y-m-d h:i:s a')
    ];
});

Route::post('register', [AuthController::class, 'register'])
    ->middleware('guest');

Route::post('login', [AuthController::class, 'login'])
    ->middleware('guest');

Route::post('logout', [AuthController::class, 'logout'])
    ->middleware('auth:sanctum');

Route::get('auth', [AuthController::class, 'auth']);

