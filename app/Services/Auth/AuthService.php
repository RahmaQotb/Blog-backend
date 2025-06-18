<?php
namespace App\Services\Auth;

use App\DTO\Auth\RegisterData;
use App\Models\User;
use App\Repositories\Contracts\AuthRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function __construct(protected AuthRepositoryInterface $authRepository) {}

    public function register(array $data): User
    {
        $data['password'] = Hash::make($data['password']);
        return $this->authRepository->register($data);
    }

    public function login(array $credentials): ?string
    {
        return $this->authRepository->login($credentials);
    }

    public function logout(): void
    {
        $this->authRepository->logout();
    }
}