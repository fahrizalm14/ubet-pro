<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DatabaseDiagramController;
use App\Http\Controllers\ProjectController;
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

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::delete('logout', [AuthController::class, 'logout']);

Route::middleware("auth.middle")
    ->controller(ProjectController::class)
    ->prefix('projects')
    ->group(function () {
        Route::get('', 'getAll');
        Route::post('', 'create');
        Route::get('/{projectId}', 'findById');
        Route::put('/{projectId}', 'update');
        Route::delete('/{projectId}', 'delete');
    });

Route::middleware("auth.middle")
    ->controller(DatabaseDiagramController::class)
    ->prefix('databases')->group(function () {
        Route::get('/{projectId}', 'getDatabaseByProjectId');
        Route::post('/tables', 'createDatabaseTable');
        Route::get('/tables/{tableId}', 'getDatabaseTable');
        Route::put('/tables/{tableId}', 'updateDatabaseTable');
        Route::delete('/tables/{tableId}', 'deleteDatabaseTable');

        Route::post('/columns', 'createDatabaseColumn');
        Route::put('/columns/{columnId}', 'updateDatabaseColumn');
        Route::delete('/columns/{columnId}', 'deleteDatabaseColumn');
        Route::get('/columns/type', 'getAllDatabaseColumnType');
    });
