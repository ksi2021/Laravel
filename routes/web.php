<?php

use App\Http\Controllers\AdminController;
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
    $users = \App\Models\Product::orderBy('id','asc')->take(5)->get();
    return view('site.Index',['data' =>$users]);
});


Route::get('game/{id}',function ($id){
    return view('site.product');
});
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
Route::middleware('role:admin')->prefix('admin')->group(function (){
    Route::get('/', [AdminController::class, 'Products'])->name('index');
    Route::get('/orders', [AdminController::class, 'index'])->name('orders');
    Route::get('/users', [AdminController::class, 'Users'])->name('users');
    Route::get('/delete_user/{id}', [UserController::class, 'Destroy']);
    Route::get('/delete_product/{id}', [\App\Http\Controllers\ProductController::class, 'Destroy']);
    Route::get('/destroy_product/{id}', [\App\Http\Controllers\ProductController::class, 'Destroy1']);
    Route::get('/delete_category/{id}', [\App\Http\Controllers\CategoryController::class, 'Destroy']);
    Route::get('/edit_category/{id}', [\App\Http\Controllers\CategoryController::class, 'view']);
    Route::get('/product_view/{id}', [\App\Http\Controllers\ProductController::class , 'view']);
    Route::post('/product_update', [\App\Http\Controllers\ProductController::class , 'update']);
    Route::post('/edit_category/{id}', [\App\Http\Controllers\CategoryController::class, 'view']);
    Route::get('/edit_product/{id}', [\App\Http\Controllers\ProductController::class, 'edit']);
    Route::get('/edit_user/{id}', [UserController::class, 'edit']);
    Route::post('/store_user',[UserController::class,'StoreUser']);
    Route::post('/update_category',[\App\Http\Controllers\CategoryController::class,'update']);
    Route::post('/user_update',[UserController::class,'update']);
    Route::post('/store_product',[\App\Http\Controllers\ProductController::class,'Store']);
    Route::get('/categories', [AdminController::class, 'Categories'])->name('categories');
    Route::post('/store_category', [\App\Http\Controllers\CategoryController::class, 'Store']);


});







