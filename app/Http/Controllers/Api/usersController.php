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
        try {
            $user = User::create([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => Hash::make($request->get('password')),
                'role_id' => 2
            ]);

            $json = [
                'success' => true,
                'error' => [
                    'code' => "200",
                    'message' => "Register success.",
                ],
            ];
            return response()->json($json, 200);
        } 
        catch (Illuminate\Database\QueryException $e) {
            $json = [
                'success' => false,
                'error' => [
                    'code' => "500",
                    'message' => "Register failed.",
                ],
            ];
            return response()->json($json, 500);
        }

    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->get('email'))->first();
        if (!$user) {
            $json = [
                'success' => false,
                'error' => [
                    'code' => "401",
                    'message' => "Invalid credentials. Please try again.",
                ],
            ];    
            return response()->json($json, 401);
        }
        $name = $user->name;

        if (Hash::check($request->get('password'), $user->password)) {

            $token = $user->createToken('token')->accessToken;

            $json = [
                'success' => true,
                'data' => [
                    'message' => "Login success.",
                    'name' => $name
                ],
            ];
            return response()->json($json, 200);
        }

        $json = [
            'success' => false,
            'error' => [
                'code' => "401",
                'message' => "Invalid credentials. Please try again.",
            ],
        ];    
        return response()->json($json, 401);
    }

    public function update(Request $request)
    {
        $user = User::where('email', $request->get('email'))->first();
        $user->name = $request->input('name');
        if($request->input('password') != ""){
            $user->password = Hash::make($request->input("password"));
        }
        $user->save();

        return response()->json("true", 200);
    }
}
