<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\WelcomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [WelcomeController::class, 'index']);

Route::prefix('pet')->group(function (){
    Route::get('/',[PetController::class, 'index']);

    Route::post('/{petId}/uploadImage', [PetController::class, 'uploadImage']);
    Route::post('/', [PetController::class, 'store']);
    Route::put('/', [PetController::class, 'update']);
    Route::get('/findByStatus', [PetController::class, 'findByStatus']);
    Route::get('/{petId}', [PetController::class, 'findPetById']);
    Route::post('/{petId}', [PetController::class, 'updateFromId']);
    Route::delete('/{petId}', [PetController::class, 'delete']);
});

Route::prefix('store')->group(function (){
    Route::post('/order', [StoreController::class, 'store']);
    Route::get('/order/{orderId}', [StoreController::class, 'findOrderById']);
    Route::delete('/order/{orderId}', [StoreController::class, 'delete']);
    Route::get('/inventory', [StoreController::class, 'getInventory']);
});

Route::prefix('user')->group(function (){
    Route::post('/createWithArray', [UserController::class, 'createUsersFromArray']);
    Route::post('/createWithList', [UserController::class, 'createUsersFromArray']);
    Route::get('/{username}', [UserController::class, 'getUserByUsername']);
    Route::put('/{username}', [UserController::class, 'update']);
    Route::delete('/{username}', [UserController::class, 'delete']);

    Route::get('/login', [LoginController::class, 'login']);
    Route::get('/logout', [LoginController::class, 'logout']);

    
    Route::post('/', [UserController::class, 'store']);
});
