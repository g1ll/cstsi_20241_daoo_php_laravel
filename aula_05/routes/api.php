<?php

use App\Http\Controllers\Api\FornecedorController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\ProdutoController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('produtos',ProdutoController::class);

Route::apiResource('fornecedores',FornecedorController::class)
    ->parameters([
        'fornecedores'=>'fornecedor'
    ]);


Route::middleware('auth:sanctum')->group(function(){

    Route::apiResource('users',UserController::class);
    Route::controller(FornecedorController::class)->group(function(){
            Route::post('fornecedores','store');
            Route::put('fornecedores/{fornecedor}','update');
            Route::delete('fornecedores/{fornecedor}','destroy');
    });
});

Route::post('login',[LoginController::class,'login']);
