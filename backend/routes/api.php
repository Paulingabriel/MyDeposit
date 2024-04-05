<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CasiersController;
use App\Http\Controllers\BoissonsController;
use App\Http\Controllers\BouteillesController;
use App\Http\Controllers\FournisseursController;
use App\Http\Controllers\CategoriesBoissonsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/fournisseurs', [FournisseursController::class, 'index']);
Route::get('/fournisseurs/{fournisseurs}', [FournisseursController::class, 'edit']);
Route::post('/fournisseurs', [FournisseursController::class, 'store']);
Route::put('/fournisseurs/{fournisseurs}', [FournisseursController::class, 'update']);
Route::delete('/fournisseurs/{fournisseurs}', [FournisseursController::class, 'destroy']);


Route::get('/bouteilles', [BouteillesController::class, 'index']);
Route::get('/bouteilles/{bouteilles}', [BouteillesController::class, 'edit']);
Route::post('/bouteilles', [BouteillesController::class, 'store']);
Route::put('/bouteilles/{bouteilles}', [BouteillesController::class, 'update']);
Route::delete('/bouteilles/{bouteilles}', [BouteillesController::class, 'destroy']);


Route::get('/casiers', [CasiersController::class, 'index']);
Route::get('/casiers/{casiers}', [CasiersController::class, 'edit']);
Route::post('/casiers', [CasiersController::class, 'store']);
Route::put('/casiers/{casiers}', [CasiersController::class, 'update']);
Route::delete('/casiers/{casiers}', [CasiersController::class, 'destroy']);


Route::get('/boissons', [BoissonsController::class, 'index']);
Route::get('/boissons/{boissons}', [BoissonsController::class, 'edit']);
Route::post('/boissons', [BoissonsController::class, 'store']);
Route::put('/boissons/{boissons}', [BoissonsController::class, 'update']);
Route::delete('/boissons/{boissons}', [BoissonsController::class, 'destroy']);


Route::get('/catégories-boissons', [CategoriesBoissonsController::class, 'index']);
Route::get('/catégories-boissons/{categories_boissons}', [CategoriesBoissonsController::class, 'edit']);
Route::post('/catégories-boissons', [CategoriesBoissonsController::class, 'store']);
Route::put('/catégories-boissons/{categories_boissons}', [CategoriesBoissonsController::class, 'update']);
Route::delete('/catégories-boissons/{categories_boissons}', [CategoriesBoissonsController::class, 'destroy']);
