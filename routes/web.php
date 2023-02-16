<?php

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

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

Route::get('/',[TodoController::class,'index'])->name('index');
Route::post('/todos/store',[TodoController::class,'store'])->name('store');
Route::post('todos/edit/{todo}',[TodoController::class,'edit'])->name('edit');
Route::delete('todos/delete/{todo}',[TodoController::class,'delete'])->name('delete');
