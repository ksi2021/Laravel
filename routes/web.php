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
    $users = \App\Models\User::all();
   return view('site.Index',['data' =>$users]);
});


//Route::get('/user/{id}', [UserController::class, 'show'])->middleware('auth');
Route::get('/users', [UserController::class, 'showAll'])->middleware('admin');
Route::get('/login', [UserController::class, 'auth'])->name('login') ;
Route::post('/login', [UserController::class, 'authPost']);
Route::get('/register', [UserController::class, 'showAll'])->name('register');
Route::post('/register', [UserController::class, 'reg']);

Route::middleware('auth')->prefix('user')->group(function (){
    Route::get('/logout', [UserController::class, 'Logout']);
    Route::get('/profile', function (){
        return [1,2,3,4,5];
    });
});







