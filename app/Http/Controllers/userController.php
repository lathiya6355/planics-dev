<?php

namespace App\Http\Controllers;

use App\Http\Requests\registerUserRequest;
use App\Models\User;
use App\services\userService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Passport;

class userController extends Controller
{
    private userService $userService;

    public function __construct(userService $userService)
    {
        $this->userService = $userService;
    }

    public function register(registerUserRequest $request)
    {
        if ($user = $this->userService->create($request->validated())) {
            $user->assignRole('Employee');
            // $token = $user->createToken("auth_Token")->accessToken;
            $user['token'] = $user->createToken("MyAuthApp")->plainTextToken;
            return $this->sendResponse($user, 'User register successfully.', 200);
        } else {
            return $this->sendError('Something went wrong.', 500);
        }
    }

    public function login(Request $request)
    {
        if (Auth::attempt($request->all())) {
            $user = Auth::user();
            $user->getRoleNames();
            // $token = $user->createToken("auth_Token")->accessToken;
            $user['token'] = $user->createToken("MyAuthApp")->plainTextToken;
            return $this->sendResponse($user, 'User login successfully.', 200);
        } else {
            return $this->sendError('Unauthorised.', 401);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return $this->sendResponse([], 'user logout', 200);
    }

    public function deleteUser($id)
    {
        $user = $this->userService->getById($id);
        $user->delete();
        return $this->sendResponse([], 'User Deleted Successfully...!');
    }
}
