<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/todo', function () {
//     return view('./todo');
// })->middleware(['auth', 'verified'])->name('todo.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route::get('/todo', [ItemController::class, 'index'])->name('todo.index');
    // Route::get('/todo/{todo}/edit', [ItemController::class, 'edit'])->name('todo.edit');
    // Route::delete('/todo/delete', [ItemController::class, 'destroy'])->name('todo.destroy');
    // Route::post('/todo', [ItemController::class, 'store'])->name('todo.store');
    // Route::get('/todo/entry', [ItemController::class, 'create'])->name('todo.entry');
});

Route::resource('todo', ItemController::class);

require __DIR__ . '/auth.php';