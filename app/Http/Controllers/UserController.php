<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use phpDocumentor\Reflection\Types\Integer;
use function PHPUnit\Framework\throwException;

class UserController extends Controller
{
    public function show(Request $request, $id)
    {
//        return view('user.profile', [
//            'user' => User::findOrFail($id)
//        ]);

        return response()->json(User::query()->where(['id' => $id])->firstOrFail() ? User::query()->where(['id' => $id])->first() : ['error' => true, 'message' => 'not found']);
    }

    public function showAll()
    {

        return view('user.RegisterForm', [
            'user' => User::all()
        ]);
    }

    public function auth(Request $request)
    {
        //  Auth::logout();
        // dd(Auth::user());
        //$e = Auth::user();
        //$name = $request->old('name');
        // dd(Session::all());
        // $e = DB::table('products')->orderBy('id')->SimplePaginate(1);


        //  dd($e->products());
        return view('user.LoginForm');
    }

    public function authPost(Request $request)
    {
//        if(Auth::attempt(['email' => 'serj.cononeko2012@mail.ru', 'password' => '1234567880']))
//        return dd($request->input());
//        return '123';

        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        //dd($credentials);
        $user = User::query()
            ->where('email', $request->input('email'))
            ->first();

        if (Auth::attempt($credentials, $remember = $request->input('remember'))) {
            $request->session()->regenerate();

            return redirect('/');
        }

        return back()->withInput()->withErrors(['message' => 'Пользователь с такими данными не найден !!!']);
    }

    public function reg(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users',
            'name' => 'required|min:3',
            'password' => 'required|min:6',
            'passwordRepeat' => ['required', 'min:6',Rule::in([$request->input('password')])]
        ]);

        $user = new User();
        $user->username = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        if ($user->save()) {
            $credentials = $request->only('email', 'password');
            Auth::attempt($credentials, $remember = true);
            return redirect('/');
        }

        return back()->withInput()->withErrors(['error' => true]);
    }

    public function Logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
