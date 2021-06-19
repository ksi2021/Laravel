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

        return view('user.LoginForm');
    }

    public function authPost(Request $request)
    {
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
            if (Auth::user()->status == 'admin') {
                return redirect('/admin');
            }
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
            'passwordRepeat' => ['required', 'min:6', Rule::in([$request->input('password')])]
        ]);

        $user = new User();
        $user->username = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        if ($user->save()) {
            $credentials = $request->only('email', 'password');
            Auth::attempt($credentials, $remember = $request->input('remember'));
            if (Auth::user()->status == 'admin') {
                return redirect('/admin');
            }
            return redirect('/');
        }

        return back()->withInput()->withErrors(['error' => true]);
    }

    public function Logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function StoreUser(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users',
            'name' => 'required|min:3',
            'password' => 'required|min:6',
            'passwordRepeat' => ['required', 'min:6', Rule::in([$request->input('password')])]
        ]);

        $user = new User();
        $user->username = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->status = $request->input('role') ? $request->input('role') : 'user';
        if ($user->save()) {
            return back()->with('success', 'Пользователь успешно создан !!!');
        }
        return back()->withInput()->withErrors(['error' => true]);
    }

    public function Destroy($id)
    {
        $user = User::query()->where(['id' => $id])->first();
        if ($user) {
            $user->delete();
        }
        return back();
    }

    public function edit($id)
    {
        $user = User::query()->where('id', $id)->firstOrFail();
        return view('Admin.EditUser', ['user' => $user]);
    }

    public function EditUser(Request $request)
    {
        $user = User::query()->where('id',Auth::user()->id)->first();
        if($request->input('email')){
            $data = User::query()->where('email', $request->input('email'))->first();
            if($data->count() > 1){return back()->withErrors(['email' => 'email already required']);}
            if($request->input('email') != Auth::user()->email){ $user->email = $request->input('email');}
        }
        if($request->input('name')){$user->username = $request->input('name');}
        if($request->input('password')){$user->password = Hash::make($request->input('password'));}
        if($user->save()){return back()->with(['success' => 'изменения успешно сохранены']);}
        return back();
    }


    public function update(Request $request)
    {
        $key = $request->session()->get('user_page') != null ? $request->session()->get('user_page')[0] : 1;


        $e = User::query()->where('id', $request->input('id'))->firstOrFail();
        if ($request->input('password')) {
            $e->password = Hash::make($request->input('password'));
        }
        if ($request->input('email')) {
            $try = User::query()->where('email', $request->input('email'))->count();
            if ($e->email != $request->input('email')) {
                if ($try >= 1) {
                    return back()->withInput()->withErrors(['email' => 'email is already required']);
                } else {
                    $e->email = $request->input('email');
                }
            }
        }
        $e->status = $request->input('status');
        $e->username = $request->input('username');
        if($e->save()) return redirect('/admin/users?page' . $key);
        return back()->withInput();
    }
}
