<?php

use App\Http\Controllers\TaskController;
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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');
Route::prefix('tasks')->group(function (){
    Route::get('/', [TaskController::class, 'index'])->name('tasks.index');
    Route::get('/create' , [TaskController::class , 'create'])->name('tasks.create');
    Route::post('/store' , [TaskController::class , 'store'])->name('tasks.store');
    Route::get('/list' , [TaskController::class , 'showList'])->name('tasks.list');
    Route::get('{id}/edit' , [TaskController::class , 'edit'])->name('tasks.edit');
    Route::post('{id}/update' , [TaskController::class , 'update'])->name('tasks.update');
    Route::get('{id}/delete' , [TaskController::class , 'destroy'])->name('tasks.delete');
});

