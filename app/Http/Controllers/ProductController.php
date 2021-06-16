<?php


namespace App\Http\Controllers;


use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    public function Store(Request $request){
        $request->validate([
            'image' => 'required|image',
            'title' => 'required',
            'body' => 'required',
            'price' => 'required'
        ]);
        $val = uniqid().".png";

        $c = new Product();
       $path = Storage::put('images/', $request->file('image'));
       $list = ['image' => $path,
            'title' =>  $request->input('title'),
            'body' => $request->input('body'),
            'category_id' => $request->input('category'),
            'price' => $request->input('price')];
       if($path){ $c->load($list)->save();}
       return back();
    }
}
