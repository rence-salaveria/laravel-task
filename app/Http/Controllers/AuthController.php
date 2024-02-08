<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Traits\HttpResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use HttpResponse;

    public function login(LoginUserRequest $request)
    {
        $fields = $request->validated();

        $credentials = [
            'email' => $fields['email'],
            'password' => $fields['password'],
        ];
        $authenticationSuccessful = Auth::attempt($credentials);

        if (! $authenticationSuccessful) {
            return $this->error('Invalid credentials', 401);
        }

        $user = User::where('email', $fields['email'])->first();

        return $this->success([
            'user' => $user,
            'token' => $user->createToken('API Token of '.$user->name)->plainTextToken,
        ], 'Logged in successfully!');
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return $this->success([], 'Logged out successfully!');
    }

    public function register(StoreUserRequest $request)
    {
        $fields = $request->validated();

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => Hash::make($fields['password']),
        ]);

        return $this->success([
            'user' => $user,
            'token' => $user->createToken('API Token of '.$user->name)->plainTextToken,
        ], 'User created successfully!', 201);
    }
}
