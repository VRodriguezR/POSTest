<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\categoriaController;
use App\Http\Controllers\marcaController;
use App\Http\Controllers\presentacioneController;
use App\Http\Controllers\productoController;
use App\Http\Controllers\clienteController;
use App\Http\Controllers\proveedoreController;
use App\Http\Controllers\compraController;

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
    return view('panel.index');
});


Route::get('/404', function () {
    return view('pages.404');
});

Route::get('/forgot', function () {
    return view('pages.forgot-password');
});

Route::view('/panel', 'panel.index')->name('panel');

Route::view('/login', 'auth.login')->name('login');

Route::resources([
    'categorias' => categoriaController::class,
    'marcas' => marcaController::class,
    'presentaciones' => presentacioneController::class,
    'productos' => productoController::class,
    'clientes' => clienteController::class,
    'proveedores' => proveedoreController::class,
    'compras' => compraController::class,
]);
