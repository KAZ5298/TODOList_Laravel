<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\Todo_itemController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    // return view('welcome');
    return view('login/index');
});

Route::resource('todo_item', Todo_itemController::class);
// Route::post('todo/{todo}/delete', [Todo_itemController::class, 'delete'])->name('todo.delete');
// Route::patch('todo/{todo}/complete', [Todo_itemController::class, 'complete'])->name('todo.complete');

Route::resource('login', LoginController::class);
