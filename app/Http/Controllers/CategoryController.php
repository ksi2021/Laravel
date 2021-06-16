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

}
