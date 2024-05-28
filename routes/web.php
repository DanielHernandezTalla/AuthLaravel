<?php

use Illuminate\Support\Facades\Auth;
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
    return redirect()->route('home');
    // return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin', [App\Http\Controllers\HomeController::class, 'admin'])->name('admin');
Route::get('/manager', [App\Http\Controllers\HomeController::class, 'manager'])->name('manager');
Route::get('/developer', [App\Http\Controllers\HomeController::class, 'developer'])->name('developer');


Route::prefix('auth')->name('datos.')->group(function () {
    Route::resource('/', App\Http\Controllers\DatosController::class);
    Route::resource('users', App\Http\Controllers\UserController::class);
    Route::resource('roles', App\Http\Controllers\RolesController::class);
    Route::resource('permissions', App\Http\Controllers\PermisosController::class);
    Route::resource('typepermissions', App\Http\Controllers\TypePermisosController::class);
    Route::delete('roles/permisos/{id}', [App\Http\Controllers\RolesController::class, 'destroyPermissions'])->name('destroyPermissions');
});

Route::prefix('/home')->name('poswebnew.')->group(function () {
    Route::get('/concentradociudad', [App\Http\Controllers\Poswebnew\ReportesPoswebController::class, 'concentradociudad'])->name('concentradociudad');
    Route::get('/ventasempleados', [App\Http\Controllers\Poswebnew\ReportesPoswebController::class, 'ventasaempleados'])->name('ventasaempleados');
});

Route::fallback(function () {
    return view('errors.404');
});
