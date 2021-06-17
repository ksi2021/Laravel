<?php


namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    public function Store(Request $request)
    {
        $request->validate([
            'image' => 'required|image',
            'title' => 'required',
            'body' => 'required',
            'category' => 'required',
            'price' => 'required'
        ]);

        $c = new Product();
        $path = $request->file('image')->store('uploads', 'public');
        $c->image = $path;
        $c->title = $request->input('title');
        $c->body = $request->input('body');
        $c->category_id = $request->input('category');
        $c->price = $request->input('price');
        if (!!$c->save()) {
            return back()->with('success', 'успех');
        }
        return back()->withErrors(['error' => 'errr']);
    }

    public function Destroy($id)
    {
        $e = Product::query()->where(['id' => $id])->first();
        if ($e->delete()) {
            return back();
        }
    }

    public function Destroy1($id)
    {
        $e = Product::query()->where(['id' => $id])->first();
        if ($e->delete()) {
            return redirect('/admin/')
//                "<script>
//                  window.history.go(-2);
//                </script>"
                ;
        }
    }


    public function view(Request $request, $id)
    {

        $data = Product::query()->where(['id' => $id])->firstOrFail();
        return view('Admin.ProductView', ['data' => $data]);
    }

    public function edit($id)
    {

        $data = Product::query()->where(['id' => $id])->firstOrFail();

        $ct = Category::query()->where(['id' => $data->category_id])->first();
        $cat = Category::query()->where('id' ,'!=',$ct->id)->get();
        return view('Admin.EditProduct', ['data' => $data, 'cat' => $cat,'ct' => $ct]);
    }
    public function update(Request $request)
    {

        $key = $request->session()->get('prod_page') != null ? $request->session()->get('prod_page')[0] : 1;

        $data = Product::query()->where(['id' => $request->input('id')])->firstOrFail();

        if($request->file('image')){
            $path = $request->file('image')->store('uploads', 'public');
            $data->image = $path;
        }
        $data->title = $request->input('title');
        $data->body = $request->input('body');
        $data->category_id = $request->input('category');
        $data->price = $request->input('price');
        if($data->save()) return redirect('/admin?page='.$key);
        else{ return back()->withInput();}
    }
}
