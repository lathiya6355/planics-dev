<?php

namespace App\Http\Controllers;

use App\Http\Requests\registerUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Passport;

class userController extends Controller
{
    public function register(registerUserRequest $request)
    {
        if ($user = User::create($request->all())) {
            $user->assignRole('Employee');
            // $token = $user->createToken("auth_Token")->accessToken;
            $user['token'] = $user->createToken("MyAuthApp")->plainTextToken;
            return $this->sendResponse($user,'User register successfully.');
        } else {
            return $this->sendError('Something went wrong.');
        }
    }

    public function login(Request $request) {
        if (Auth::attempt($request->all())) {
            $user = Auth::user();
            $user->getRoleNames();
            // $token = $user->createToken("auth_Token")->accessToken;
            $user['token'] = $user->createToken("MyAuthApp")->plainTextToken;
            return $this->sendResponse($user,'User login successfully.');
        } else {
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        }
    }

    public function logout(Request $request) {
        $request->user()->tokens()->delete();
        return $this->sendResponse([],'user logout');
    }
}
