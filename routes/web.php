<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ToDoController;

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


Route::resource('/', ToDoController::class)->except(['show']);
Route::resource('todos', ToDoController::class)->except(['show']);
Route::post('todos/complete/{id}', [ToDoController::class, 'complete'])->name('todos.complete');
Route::get('todos/show-all', [ToDoController::class, 'showAll'])->name('todos.showAll');


// Route::get('/', function () {
//     return view('welcome');
// });
