<?php


namespace App\Http\Controllers;


use App\Models\Product;
use App\Models\purchases;
use Illuminate\Http\Request;


class OrderController extends Controller
{
    public function destroy(Request $request){
       // var_dump($request->id);
        $key = $request->session()->get('order_page') != null ? $request->session()->get('order_page')[0] : 1;
        $data = purchases::query()->where(['id' => $request->id])->firstOrFail();

        if (!!$data->delete()) return redirect('/admin/orders?page=' . $key);
        else {
            return back()->withInput();
        }
    }
}
