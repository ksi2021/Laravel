<?php


namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        return view('Admin.index');
    }

    public function Users(){
        $users = DB::table('users')->orderBy('id')->SimplePaginate(5);
        return view('admin.users', ['data' => $users]);
    }

    public function Categories(){
        $cat = DB::table('categories')->orderBy('id')->SimplePaginate(5);
        return view('admin.categories', ['data' => $cat]);
    }

    public function Products(){
        $cat = Category::all();
        $data = DB::table('products')->orderBy('id')->SimplePaginate(5);
        return view('admin.products', ['data' => $data, 'cat' => $cat]);
    }

}
