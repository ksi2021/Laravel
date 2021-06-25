<?php


namespace App\Http\Controllers;


use App\Models\basket;
use App\Models\purchases;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'games' => 'required|json',
            'basket' => 'required|json'
        ]);

        $basket = json_decode($request->input('basket'),true);
        $games = json_decode($request->input('games'),true);

        foreach ($basket as $key => $game){
//            var_dump($game);die();

            $e = new purchases();
            $e->prod_id = $game['prod_id'];
            $e->user_id = $game['user_id'];
            if($e->save()){basket::where('id' ,$game['id'])->first()->delete();}
        }
       return redirect('/user/games');
    }

}
