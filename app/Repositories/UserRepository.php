<?php

namespace App\Repositories;

use App\Models\User;
use App\Services\IUserService;
use Core\Database;
use PDO;

class UserRepository implements IUserService{
    private $connection;

    public function __construct()
    {
        $this->connection = (new Database()) -> getConnection();
    }

    public function register(User $user)
    {
        $stmt = $this->connection->prepare(
            "INSERT INTO users (name, email, password)
             VALUES (:name, :email, :password)"
        );

        return $stmt->execute([
            ':name' => $user->getName(),
            ':email' => $user->getEmail(),
            ':password' => password_hash($user->getPassword(), PASSWORD_BCRYPT)
        ]);
    }

    public function getAllUsers()
    {
        $stmt = $this->connection->query("SELECT * FROM users");
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $users = [];

        foreach ($rows as $row) {
            $users[] = new User(
                $row['name'],
                $row['email'],
                $row['password'],
                $row['id']
            );
        }

        return $users;
    }

    public function getUserById($id)
    {
        $stmt = $this->connection->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute([':id' => $id]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        return new User(
            $row['name'],
            $row['email'],
            $row['password'],
            $row['id']
        );
    }

    public function getUserByEmail($email)
    {
        $stmt = $this->connection->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute([':email' => $email]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        return new User(
            $row['name'],
            $row['email'],
            $row['password'],
            $row['id']
        );
    }
}
