<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Firebase\DataController;

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
    return view('home');
});

Route::get('data', [DataController::class, 'index']);
Route::get('create', [DataController::class, 'create']);
Route::post('store', [DataController::class, 'store']);
Route::get('delete/{id}', [DataController::class, 'destroy']);
Route::get('detail/{id}', [DataController::class, 'show']);
Route::get('edit/{id}', [DataController::class, 'edit']);
Route::put('update/{id}', [DataController::class, 'update']);
Route::get('download/{id}', [PDFController::class, 'generatePDF']);
