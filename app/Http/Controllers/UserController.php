<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use App\Services\User\UserService;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function login(LoginRequest $request)
    {
        $payload = $request->validated();
        $token = $this->userService->login($payload);
        if (!$token) {
            return ResponseFormatter::error(null, 'Invalid credentials', 401);
        }
        return ResponseFormatter::success($token, 'Login successfully');
    }
}
