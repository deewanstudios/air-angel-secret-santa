<?php

use App\Http\Controllers\SecretSantaController;
use App\Http\Controllers\HomeController;
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

Route::get('/', [SecretSantaController::class, 'show']);
Route::get('secret-santa/add', [HomeController::class, 'index']);
Route::post('secret-santa/process', [HomeController::class, 'processForm']);
