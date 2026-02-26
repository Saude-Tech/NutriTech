<?php

namespace App\Repositories;

use Core\Database;
use App\Models\User;
use App\Interfaces\IUserRepository;
use PDO;

class UserRepository implements IUserRepository
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAll(): array
    {
        $stmt = $this->db->getConnection()->query("SELECT * FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function create(User $user): User
    {
        $stmt = $this->db->getConnection()->prepare(
            "INSERT INTO users (name, email, password, foto, created_at)
         VALUES (:name, :email, :password, :foto, :created_at)"
        );

        $stmt->execute([
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),
            'foto' => $user->getFoto(),
            'created_at' => date('Y-m-d H:i:s')
        ]);

        $userId = (int)$this->db->getConnection()->lastInsertId();

        return User::fromArray([
            'id' => $userId,
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),
            'foto' => $user->getFoto(),
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }

    public function findByEmail(string $email): ?User
    {
        $stmt = $this->db->getConnection()->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data ? User::fromArray($data) : null;
    }
}
