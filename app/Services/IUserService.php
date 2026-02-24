<?php

namespace App\Services;

use App\Models\User;

interface IUserService
{
    public function register(User $user);
    public function getAllUsers();
    public function getUserById($id);
}
