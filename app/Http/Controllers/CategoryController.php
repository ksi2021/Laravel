<?php


namespace App\Http\Controllers;


use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function Destroy($id){
        $el = Category::query()->where(['id' => $id])->first();
        if($el){$el->delete();}
        return back();
    }
    public function Store(Request $request){
        $request->validate([
           'name' => 'required|unique:categories'
        ]);

        $data = new Category();
        $data->name = $request->input('name');
        if($data->save()){
            return back()->with('success','Категория успешно создана');
        }
        return back()->withInput()->withErrors();
    }
//    public function update(Request $request){
//        $data = Category::query()->where(['id' => $request->input('id')])->firstOrFail();
//        $data->name = $request->input('name');
//        if($data->save()){return back();}
//    }
    public function view(Request $request,$id){
        if(!empty($_POST))
        {
            $key = $request->session()->get('cat_page') != null ? $request->session()->get('cat_page')[0] : 1;
            $data = Category::query()->where(['id' => $request->input('id')])->firstOrFail();
            $data->name = $request->input('name');
            if($data->save()){return redirect('/admin/categories?page'.$key );}
        }
        $data = Category::query()->where(['id' => $id])->firstOrFail();
        return view('Admin.CatView',['data' => $data]);
    }


}
