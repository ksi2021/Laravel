<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

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
}
