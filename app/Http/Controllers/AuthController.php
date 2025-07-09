<?php
namespace App\Http\Controllers;

use App\Services\AuthService;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function __construct(protected AuthService $service) {}

    public function register(RegisterRequest $request)
    {
        $result = $this->service->register($request->validated());
        return ApiResponse::success($result, 'Registration successful', 201);
    }

    public function login(LoginRequest $request)
    {
        $result = $this->service->login($request->validated());
        if (!$result) {
            return ApiResponse::error('Invalid credentials', 401);
        }
        return ApiResponse::success($result, 'Login successful');
    }

    public function logout(Request $request)
    {
        $this->service->logout($request->user());
        return ApiResponse::success(null, 'Logged out');
    }
}