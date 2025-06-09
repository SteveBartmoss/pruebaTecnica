<?php 

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProyectosController;
use App\Http\Controllers\TareasController;

Route::middleware('auth:sactum')->get('/user', function (Request $reques) {
    return $request->user();
});

Route::group(['prefix' => 'auth'], function () {

    Route::post('login', [AuthController::class, 'login']);
    Route::post('user', [AuthController::class, 'register']);

    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('logout', [AuthController::class, 'logout']);
        Route::get('user', [AuthController::class, 'user']);
    });

});

Route::group(['prefix' => 'proyectos'], function (){
    
    Route::get('getProyectos',[ProyectosController::class, 'getProject']);
    Route::post('createProyecto', [ProyectosController::class, 'createProject']);
    Route::post('updateProyecto', [ProyectosController::class, 'updateProject']);
    Route::post('deleteProyecto', [ProyectosController::class, 'deleteProject']);

});

Route::group(['prefix' => 'tareas'], function (){
    
    Route::get('getTareas',[TareasController::class, 'getTask']);
    Route::post('createTarea', [TareasController::class, 'createTask']);
    Route::post('updateTarea', [TareasController::class, 'updateTask']);
    Route::post(['deleteTarea', TareasController::class, 'deleteTask']);
    Route::post('completeTarea', [TareasController::class, 'completeTask']);

});

