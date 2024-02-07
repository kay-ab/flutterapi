<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login(Request $request) {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt(['email' => $request->input('email'),'password' => $request->input('password')])) {
            $user = auth()->user();
            $api = $user->createToken('Auth')->accessToken;

            return response()->json([
                'status' => true,
                'message' => 'User Login Successfully',
                'api'   => $api
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Email or password are incorrect.',
                'api'   => ''
            ]);
        }
    }

    public function index () {
        return User::all();
    }

    public function create (Request $request) {
        $user = User::create([
            'name'      => $request->input('name'),
            'email'     => $request->input('email'),
            'password'  => $request->input('password')
        ]);

        $api = $user->createToken('Api Token')->accessToken;

        return response()->json([
            'status'  => true,
            'message' => 'User created Successfully.',
            'api'     => $api
        ]);
    }

    public function redirect () {
        $info = ['message' => 'You Need To Authoirzed'];

        return $info;
    }
}
