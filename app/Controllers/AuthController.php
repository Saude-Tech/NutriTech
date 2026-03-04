<?php

namespace App\Controllers;

use App\Models\User;
use Core\Auth;

class AuthController
{
public function index(): void
{
    if (Auth::check()) {
        header('Location: /nutritech/index');
        exit;
    }

    include __DIR__ . '/../views/auth/login.php';
}

    public function login(): void
    {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $user = User::findByEmail($email);

        if (!$user || !password_verify($password, $user->getPassword())) {
            // ⚡ Flash message
            $_SESSION['error'] = "Credenciais inválidas";

            // Redireciona para a rota /auth
            header('Location: /nutritech/auth');
            exit;
        }

        // Login válido
        $_SESSION['user_id'] = $user->getId();
        header('Location: /nutritech/dashboard');
        exit;
    }

    public function register(): void
    {
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirmPassword = $_POST['register-confirm'] ?? '';

        // Verifica se email já existe
        if (User::findByEmail($email)) {
            $_SESSION['error'] = "Email já registrado";
            header('Location: /nutritech/auth');
            exit;
        }



        $user = new User($name, $email, $password);
        $user->save();

        // Login automático após registro
        $_SESSION['user_id'] = $user->getId();
        header('Location: /nutritech/dashboard');
        exit;
    }

}
