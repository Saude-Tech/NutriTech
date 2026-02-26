<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use App\Exceptions\EmailAlreadyRegisteredException;
use App\Exceptions\InvalidCredentialsException;

class AuthService
{
    private UserRepository $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function register(string $name, string $email, string $password, ?string $foto = null): User
    {
        if ($this->userRepo->findByEmail($email)) {
            throw new EmailAlreadyRegisteredException($email);
        }
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $user = new User($name, $email, $hashedPassword, $foto);
        return $this->userRepo->create($user);
    }

    public function create(string $name, string $email, string $password, ?string $foto = null): User
    {
        return $this->register($name, $email, $password, $foto);
    }

    public function findByEmail(string $email): ?User
    {
        return $this->userRepo->findByEmail($email);
    }

    public function login(string $email, string $password): User
    {
        $user = $this->userRepo->findByEmail($email);
        if (!$user || !password_verify($password, $user-> getPassword())) {
            throw new InvalidCredentialsException();
        }
        return $user;
    }
}
