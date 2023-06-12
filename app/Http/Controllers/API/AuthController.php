<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Profile;

class AuthController extends Controller
{   
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|email|unique:profiles',
            'password' => 'required|string|min:8'
        ]);


        if ($validator->fails())
            return response()->json($validator->errors());

        $profile = Profile::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $profile->createToken('auth_token')->plainTextToken;

        return response()->json(['data' => $profile, 'access_token' => $token, 'token_type' => 'Bearer']);
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()
                ->json(['message' => 'Unauthorized'], 401);
        }

        $profile = Profile::where('email', $request['email'])->firstOrFail();

        $token = $profile->createToken('auth_token')->plainTextToken;

        return response()
            ->json(['message' => 'Hi ' . $profile->name . ', welcome back!', 'access_token' => $token, 'token_type' => 'Bearer',]);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return [
            'message' => 'You have successfully logged out, goodbye!'
        ];
    }
    
}
