<?php

use Illuminate\Support\Facades\Route;
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
    return view('welcome');
});

Route::get('data', [DataController::class, 'index']);
Route::get('create', [DataController::class, 'create']);
<<<<<<< HEAD
Route::get('create', [DataController::class, 'store']);
=======
Route::get('delete/{ID}', [DataController::class, 'destroy']);
>>>>>>> 9de1166958bdf1c9a89522ef490954935db8a53d
