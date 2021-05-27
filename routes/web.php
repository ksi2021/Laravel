<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
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

Route::get('/', function (Request $request) {
   // return dd($request);
   return view('welcome');
});


Route::get('/user/{id}', [UserController::class, 'show']);
Route::get('/users', [UserController::class, 'showAll']);
Route::get('/form', [UserController::class, 'auth']);
Route::post('/auth', [UserController::class, 'authPost']);


