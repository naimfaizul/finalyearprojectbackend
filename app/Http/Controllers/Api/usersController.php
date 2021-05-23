<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;


class usersController extends Controller
{

    public function register(Request $request)
    {
        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password'))
        ]);
    
        return $user;
    }

    public function login(Request $request)
    {

        $user = User::where('email', $request->get('email'))->first();
        if (!$user) {
            abort(401, 'Invalid login email or password');
        }

        if (Hash::check($request->get('password'), $user->password)) {

            $token = $user->createToken('token')->accessToken;

            return [
                'user' => $user,
                'token' => $token
            ];
        }
        abort(401, 'Invalid login page');
    }

    public function update(Request $request)
    {
       
        $user->name = $request->input('name');
        dd($user);

        return $user;
    }
}
