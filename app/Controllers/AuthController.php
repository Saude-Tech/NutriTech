<?php

namespace App\Controllers;

use App\Services\AuthService;
use App\Exceptions\EmailAlreadyRegisteredException;
use App\Exceptions\InvalidCredentialsException;

class AuthController
{
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(array $data): array
    {
        try {
            $user = $this->authService->register(
                $data['name'],
                $data['email'],
                $data['password'],
                $data['foto'] ?? null
            );
            return ['success' => true, 'user' => $user];
        } catch (EmailAlreadyRegisteredException $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function login(array $data): array
    {
        try {
            $user = $this->authService->login($data['email'], $data['password']);
            return ['success' => true, 'user' => $user];
        } catch (InvalidCredentialsException $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }
}
