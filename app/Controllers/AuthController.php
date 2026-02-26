<?php

namespace App\Controllers;

use App\Services\AuthService;
use App\Repositories\UserRepository;
use App\Exceptions\EmailAlreadyRegisteredException;
use App\Exceptions\InvalidCredentialsException;

class AuthController
{
    private AuthService $authService;

    public function __construct()
    {
        $userRepository = new UserRepository();
        $this->authService = new AuthService($userRepository);
    }

    public function index(): void
    {
        include __DIR__ . '/../views/auth/login.php';
    }

    public function login(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $input = json_decode(file_get_contents('php://input'), true);
            $data = $input ?? $_POST;

            $email = $data['email'] ?? null;
            $password = $data['password'] ?? null;

            try {
                $user = $this->authService->login($email, $password);
                $_SESSION['user'] = $user;

                if (!empty($input)) {
                    header('Content-Type: application/json');
                    echo json_encode(['success' => true, 'user' => $user->toArray()]);
                    exit;
                }

                header('Location: /dashboard');
                exit;
            } catch (InvalidCredentialsException $e) {
                if (!empty($input)) {
                    header('Content-Type: application/json');
                    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
                    exit;
                }

                $error = $e->getMessage();
                include __DIR__ . '/../views/auth/login.php';
            }
        } else {
            $this->index();
        }
    }

    public function register(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $name = $_POST['name'] ?? null;
            $email = $_POST['email'] ?? null;
            $password = $_POST['password'] ?? null;

            try {

                // Verificar se o email já está registrado
                $existingUser = $this->authService->findByEmail($email);
                if ($existingUser) {
                    throw new EmailAlreadyRegisteredException("Email já registrado.");
                    exit;
                }

                // Para simplificar, estamos usando o mesmo método de registro para criar usuários
                $user = $this->authService->register($name, $email, $password);

                $_SESSION['user'] = $user;

                header('Location: /dashboard');
                exit;
            } catch (EmailAlreadyRegisteredException $e) {
                $error = $e->getMessage();
                include __DIR__ . '/../views/auth/login.php';
            }
        }
    }
}
