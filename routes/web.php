<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UnidadMedidaController;
use App\Http\Controllers\TipoProductoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\AlmacenController;
use App\Http\Controllers\MotivoIngresoController;
use App\Http\Controllers\MotivoSalidaController;
use App\Http\Controllers\ProveedorController;

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
    
    Route::get('/almacen/datatables', [AlmacenController::class, 'datatables'])->name('almacen.data');
    Route::get('/almacen/info-list', [AlmacenController::class, 'info_list_alm'])->name('almacen.info_list_alm');
    Route::resource('almacen', AlmacenController::class);

    Route::get('/unidad_medida/datatables', [UnidadMedidaController::class, 'datatables'])->name('unidad_medida.data');
    Route::resource('unidad_medida', UnidadMedidaController::class);

    Route::get('/tipo_producto/datatables', [TipoProductoController::class, 'datatables'])->name('tipo_producto.data');
    Route::get('/tipo_producto/info-list', [TipoProductoController::class, 'info_list_tip'])->name('tipo_producto.info_list_tip');
    Route::resource('tipo_producto', TipoProductoController::class);

    Route::get('/motivo_ingreso/datatables', [MotivoIngresoController::class, 'datatables'])->name('motivo_ingreso.data');
    Route::get('/motivo_ingreso/info-list', [MotivoIngresoController::class, 'info_list_mot'])->name('motivo_ingreso.info_list_mot');
    Route::resource('motivo_ingreso', MotivoIngresoController::class);
    
    Route::resource('producto', ProductoController::class);
    Route::resource('motivo_salida', MotivoSalidaController::class);
    Route::resource('proveedor', ProveedorController::class);
});

require __DIR__.'/auth.php';
