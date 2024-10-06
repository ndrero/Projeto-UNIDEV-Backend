<?php

use App\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::get('/times', [TeamController::class, 'getAll']);
Route::get('/times/sem-jogadores', [TeamController::class, 'getWithoutPlayers']);
Route::get('/times/{id}', [TeamController::class, 'getById']);
Route::post('/times', [TeamController::class, 'createTeam']);
Route::put('/times/{id}', [TeamController::class, 'updateTeam']);
Route::delete('/times/{id}', [TeamController::class, 'deleteTeam']);
