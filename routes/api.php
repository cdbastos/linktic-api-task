<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//crea la ruta para crear una tarea
Route::get('/tasks', [\App\Http\Controllers\Api\TaskController::class, 'index'])
    ->name('api.tasks.index');

//crea la ruta para obtener el listado de tareas
Route::post('/tasks', [\App\Http\Controllers\Api\TaskController::class, 'store'])
    ->name('api.tasks.store');

//crea la ruta para obtener una tarea por id
Route::get('/tasks/{task}', [\App\Http\Controllers\Api\TaskController::class, 'show'])
    ->name('api.tasks.show')
;

//crea la ruta para actualizar una tarea por id
Route::put('/tasks/{task}', [\App\Http\Controllers\Api\TaskController::class, 'update'])
    ->name('api.tasks.update')
;


//crea la ruta para borrar una tarea por id
Route::delete('/tasks/{task}', [\App\Http\Controllers\Api\TaskController::class, 'destroy'])
    ->name('api.tasks.destroy');
