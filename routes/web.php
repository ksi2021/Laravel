<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

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
    $users = \App\Models\Product::orderBy('id', 'asc')->take(5)->get();
    $sales = \App\Models\Product::where('newprice', '>', '0')->orderBy('newprice', 'desc')->take(15)->get();
    $free = \App\Models\Product::where('price', '0')->take(10)->get();
    return view('site.Index', ['data' => $users, 'sales' => $sales, 'free' => $free]);
});


Route::get('/game/{id}', function ($id) {
    $rait = \App\Models\rait::where('prod_id', '=', $id)->get();
    $r_base = 0;
    $is_vote = false;
    $is_bought = false;
    $sold = false;
    if ($rait->count() > 0) {
        foreach ($rait as $r) {
            $r_base += $r->rait;
        }
        $r_base /= $rait->count();
    }
    $game = \App\Models\Product::query()->where('id', $id)->firstOrFail();
    if (\Illuminate\Support\Facades\Auth::check()) {
        $e = \App\Models\rait::whereRaw('prod_id = ? AND user_id = ?', [$id, Auth::user()->id])->first();
        $is_vote = $e == null ? false : $e->rait;
        $buy = \App\Models\basket::whereRaw('prod_id = ? AND user_id = ?', [$id, Auth::user()->id])->first();
        $is_bought = $buy == null ? false : true;
        $purch = \App\Models\purchases::whereRaw('prod_id = ? AND user_id = ?', [$id, Auth::user()->id])->first();
        $sold = $purch == null ? false : true;
    }
    return view('site.game', ['game' => $game, 'rait' => $r_base, 'vote' => $is_vote, 'bought' => $is_bought, 'sold' => $sold]);


});

Route::get('/api/games',function (Request $request){
    $e = \App\Models\Product::all();
    return Illuminate\Http\Resources\Json\JsonResource::make($e);
});


Route::get('/games', function (Request $request) {

    if ($request->get('query')) {
        switch ($request->get('query')) {
            case 'new':
                $games = DB::table('products')->orderBy('id', 'asc')->limit(30)->SimplePaginate(9);
                break;
            case 'sale':
                $games = DB::table('products')->whereRaw('newprice != 0')->SimplePaginate(9);
                break;
            default:
                $games = DB::table('products')->SimplePaginate(9);
                break;
        }
    }
    else{
        $games = DB::table('products')->SimplePaginate(9);
    }
    $c = $request->get('query');
    return view('site.games', ['games' => $games, 'c' => $c]);
});


Route::get('/users', [UserController::class, 'showAll'])->middleware('admin');
Route::get('/login', [UserController::class, 'auth'])->name('login');
Route::post('/login', [UserController::class, 'authPost']);
Route::get('/register', [UserController::class, 'showAll'])->name('register');
Route::post('/register', [UserController::class, 'reg']);


Route::middleware('auth')->prefix('user')->group(function () {
    Route::get('/logout', [UserController::class, 'Logout']);
    Route::get('/add_to_basket/{id}', [\App\Http\Controllers\BasketController::class, 'store']);
    Route::post('/purchase', [\App\Http\Controllers\PurchaseController::class, 'store']);
    Route::get('/delete_from_basket/{id}', [\App\Http\Controllers\BasketController::class, 'destroy']);
    Route::get('/assessment/{id}/{value}', [\App\Http\Controllers\RaitController::class, 'store']);
    Route::get('/basket', function () {
        $items = \App\Models\basket::where('user_id', Auth::user()->id)->get();
        $products = \App\Models\Product::all();
        return view('site.basket', ['items' => $items, 'products' => $products]);
    });
    Route::get('/profile', function () {
        return [1, 2, 3, 4, 5];
    });
    Route::get('/games',function (){
        $products = \App\Models\Product::all();
        $items = \App\Models\purchases::where('user_id', Auth::user()->id)->get();
        return view('user.games',['products' => $products, 'items' => $items]);
    });
});
Route::middleware('role:admin')->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'Products'])->name('index');
    Route::get('/orders', [AdminController::class, 'Orders'])->name('orders');
    Route::get('/users', [AdminController::class, 'Users'])->name('users');
    Route::get('/delete_user/{id}', [UserController::class, 'Destroy']);
    Route::get('/delete_order/{id}', [\App\Http\Controllers\OrderController::class, 'Destroy']);
    Route::get('/delete_product/{id}', [\App\Http\Controllers\ProductController::class, 'Destroy']);
    Route::get('/destroy_product/{id}', [\App\Http\Controllers\ProductController::class, 'Destroy1']);
    Route::get('/delete_category/{id}', [\App\Http\Controllers\CategoryController::class, 'Destroy']);
    Route::get('/edit_category/{id}', [\App\Http\Controllers\CategoryController::class, 'view']);
    Route::get('/product_view/{id}', [\App\Http\Controllers\ProductController::class, 'view']);
    Route::post('/product_update', [\App\Http\Controllers\ProductController::class, 'update']);
    Route::post('/edit_category/{id}', [\App\Http\Controllers\CategoryController::class, 'view']);
    Route::get('/edit_product/{id}', [\App\Http\Controllers\ProductController::class, 'edit']);
    Route::get('/edit_user/{id}', [UserController::class, 'edit']);
    Route::post('/store_user', [UserController::class, 'StoreUser']);
    Route::post('/update_category', [\App\Http\Controllers\CategoryController::class, 'update']);
    Route::post('/user_update', [UserController::class, 'update']);
    Route::post('/store_product', [\App\Http\Controllers\ProductController::class, 'Store']);
    Route::get('/categories', [AdminController::class, 'Categories'])->name('categories');
    Route::post('/store_category', [\App\Http\Controllers\CategoryController::class, 'Store']);


});







