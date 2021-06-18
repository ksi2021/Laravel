<?php


namespace App\Http\Controllers;


use App\Models\rait;
use Illuminate\Support\Facades\Auth;

class RaitController extends Controller
{
    public function store($id,$value){
            $rait = new rait();
            $rait->prod_id = $id;
            $rait->rait = $value;
            $rait->user_id = Auth::user()->id;
            $rait->save();
            return back();

    }

}
