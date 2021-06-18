<?php


namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\Product;
use App\Models\purchases;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        return view('Admin.index');
    }

    public function Users(Request $request){
        session()->forget('user_page');
        $request->session()->push('user_page', ($request->page == null ? 1:$request->page));

        $users = DB::table('users')->orderBy('id')->SimplePaginate(10);
        return view('admin.users', ['data' => $users]);
    }

    public function Categories(Request $request){
        session()->forget('cat_page');
        $request->session()->push('cat_page', ($request->page == null ? 1:$request->page));
        $cat = DB::table('categories')->orderBy('id')->SimplePaginate(10);
        return view('admin.categories', ['data' => $cat]);
    }

    public function Products(Request $request){
        session()->forget('prod_page');
        $request->session()->push('prod_page', ($request->page == null ? 1:$request->page));
        $cat = Category::all();
        $data = DB::table('products')->orderBy('id')->SimplePaginate(5);
        return view('admin.products', ['data' => $data, 'cat' => $cat]);
    }

    public function Orders(Request $request){
        session()->forget('order_page');
        $request->session()->push('order_page', ($request->page == null ? 1:$request->page));
        $products = Product::all();
        $data = DB::table('purchases')->orderBy('id')->SimplePaginate(10);
        return view('admin.orders', ['data' => $data, 'cat' => $products]);
    }

}
