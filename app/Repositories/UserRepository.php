<?php

namespace App\Repositories;

use App\Core\Database;
use App\Models\User;
use App\Interfaces\IUserRepository;
use PDO;

class UserRepository implements IUserRepository
{
    private $db;

    public function __construct()
    {
        $this-> db = new Database();

    }

    public function getAll(): array
    {
        $stmt = $this->db->getConnection()->query("SELECT * FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(User $user): User
    {
        $stmt = $this->db->getConnection()->prepare("INSERT INTO users (name, email, password, foto, created_at) VALUES (:name, :email, :password, :foto, :created_at)");
        $stmt->execute($user->toArray());
        $userId = (int)$this->db->getConnection()->lastInsertId();
        return User::fromArray(array_merge($user->toArray(), ['id' => $userId]));
    }

    public function findByEmail(string $email): ?User
    {
        $stmt = $this->db->getConnection()->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data ? User::fromArray($data) : null;
    }
}
