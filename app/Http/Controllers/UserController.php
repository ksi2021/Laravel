<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function show($id)
    {
//        return view('user.profile', [
//            'user' => User::findOrFail($id)
//        ]);
        return response()->json(User::findOrFail($id));
    }
    public function showAll()
    {
        return view('user.profile', [
            'user' => User::all()
        ]);
    }

    public function auth(Request $request)
    {
      //  Auth::logout();
       // dd(Auth::user());
        $e =  Auth::user();
        $name= $request->old('name');
       // dd(Session::all());
        return view('form',['e'=> $e,'name' =>$name]);
    }

    public function authPost(Request  $request)
    {
//        if(Auth::attempt(['email' => 'serj.cononeko2012@mail.ru', 'password' => '1234567880']))
//        return dd($request->input());
//        return '123';

        $request->validate([
            'name' => 'required|min:6',

        ]);

        $credentials = $request->only('email', 'password');
        //dd($credentials);
        $user = User::query()
            ->where('email', $request->input('email'))
            ->first();

        if (Auth::attempt($credentials,$remember = true)) {
            $request->session()->regenerate();

            return redirect('form');
        }

        return back();
    }
}
