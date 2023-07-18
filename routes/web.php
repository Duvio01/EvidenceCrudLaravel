<?php

use App\Http\Controllers\OperadoresController;
use App\Http\Controllers\OrdentrabController;
use App\Http\Controllers\TipoOrdenController;
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

Route::get('/', [OrdentrabController::class, 'indexOrder'])->name('index');

Route::resource('operadores',OperadoresController::class);
Route::resource('tipoOrden', TipoOrdenController::class);

Route::post('saveAssign', [OrdentrabController::class, 'saveAssign'])->name('saveAssign');
Route::post('saveOrder', [OrdentrabController::class, 'saveOrder'])->name('saveOrder');
Route::post('saveResult', [OrdentrabController::class, 'saveResult'])->name('saveResult');
