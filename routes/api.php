<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\TodoItemController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\SendEmailController;

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

Route::group(['prefix' => 'todo'], function () {
    Route::get('getTodoItems', [TodoItemController::class, 'getTodoItems']);
    Route::post('createTodoItem', [TodoItemController::class, 'createTodoItem']);
    Route::put('updateTodoItem', [TodoItemController::class, 'updateTodoItem']);
    Route::delete('deleteTodoItem', [TodoItemController::class, 'deleteTodoItem']);
    Route::get('getDeletedTodoItems', [TodoItemController::class, 'getDeletedTodoItems']);
    Route::post('restoryDeletedTodoItem', [TodoItemController::class, 'restoryDeletedTodoItem']);
    Route::get('exportExcel', [TodoItemController::class, 'exportExcel']);
});

Route::group(['prefix' => 'user'], function () {
    Route::get('/getUsers', [UserController::class, 'getUsers']);
    Route::post('/createUser', [UserController::class, 'createUser']);
    Route::put('/updateUser', [UserController::class, 'updateUser']);
    Route::delete('/deleteUser', [UserController::class, 'deleteUser']);
});

Route::get('send-email', [SendEmailController::class, 'index']);