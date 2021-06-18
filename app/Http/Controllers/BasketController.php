<?php


namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use App\Models\basket;

class BasketController extends Controller
{
 public function store($id){
     $data = new basket();
     $data->user_id = Auth::user()->id;
     $data->prod_id = $id;
     $data->save();
     return back();
 }
 public function destroy($id){
        $e= basket::where('id' ,$id)->firstorFail();
        if($e->user_id == Auth::user()->id || Auth::user()->status == 'admin'){$e->delete();}
        return back();
 }
}
