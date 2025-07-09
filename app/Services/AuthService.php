<?php

namespace App\Services;

use App\Repositories\AuthRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function __construct(protected AuthRepositoryInterface $repo) {}

    public function register(array $data): array
    {
        $user = $this->repo->createUser([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
        $token = $user->createToken('api_token')->plainTextToken;

        return [
            'user'  => $user,
            'token' => $token,
        ];
    }

    public function login(array $data): ?array
    {
        $user = $this->repo->findByEmail($data['email']);
        if (!$user || !Hash::check($data['password'], $user->password)) {
            return null;
        }
        $token = $user->createToken('api_token')->plainTextToken;
        return [
            'user'  => $user,
            'token' => $token,
        ];
    }

    public function logout($user): void
    {
        $user->currentAccessToken()->delete();
    }
}
