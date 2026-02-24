<?php

namespace App\Controllers;

use App\Repositories\UserRepository;

class AuthController
{

    public function index()
    {
        require_once __DIR__ . '/../Views/login.php';
    }

    public function login()
    {
        $repository = new UserRepository();

        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = $repository->getUserByEmail($email);

        if ($user && password_verify($password, $user->getPassword())) {
            $_SESSION['user'] = $user->getId();
            header('Location: /dashboard');
            exit;
        } else {
            $error = "Email ou senha inválidos";
            require '../src/Views/login.php';
        }
    }

}
