<?php

namespace App\Interfaces;

use App\Models\User;

interface IUserRepository
{
    public function create(User $user): User;
    public function findByEmail(string $email): ?User;
}
