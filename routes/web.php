<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
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

Route::middleware(['auth'])->group(function () {

    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('permission:acceso usuarios')->group(function () {
        Route::get('/adm/usuarios/datatables', [UserController::class, 'datatables'])->name('users.data');
        Route::post('/adm/usuarios/{usuario}/password', [UserController::class, 'updatePassword'])->name('usuarios.updatePassword');
        Route::get('/adm/usuarios/info_list_usu', [UserController::class, 'info_list_usu'])->name('usuarios.info_list_usu');
        Route::resource('/adm/usuarios', UserController::class);       
    });


});

require __DIR__.'/auth.php';
