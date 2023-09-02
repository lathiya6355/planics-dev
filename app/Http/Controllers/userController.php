<?php

namespace App\Http\Controllers;

use App\Http\Requests\loginRequest;
use App\Http\Requests\registerUserRequest;
use App\Models\User;
use App\services\userService;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Laravel\Passport\Passport;
// use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
// use Symfony\Component\HttpFoundation\Session\Session as SessionSession;

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

    public function login(loginRequest $request)
    {
        if (Auth::attempt($request->all())) {
            $user = Auth::user();
            $user->getRoleNames();
            $user['token'] = $user->createToken("MyAuthApp")->plainTextToken;
            return $this->sendResponse($user, 'User login successfully.', 200);
        } else {
            return $this->sendError('Please enter valid Email and Password.', 401);
        }
    }

    public function logout(Request $request)
    {
        // dd($request->all());
        $request->user()->tokens()->delete();
        return $this->sendResponse([], 'user logout', 200);
    }

    public function deleteUser($id)
    {
        $user = $this->userService->getById($id);
        $user->delete();
        return $this->sendResponse([], 'User Deleted Successfully...!');
    }

    public function refresh(Request $request)
{
    $request->user()->tokens()->delete();
    $token = $request->user()->createToken('refresh Token')->plainTextToken;
    return $this->sendResponse($token,'Refresh Token...!');

    // return response()->json([ ]);
}
}
