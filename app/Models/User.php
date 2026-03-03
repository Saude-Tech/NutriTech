<?php

namespace App\Models;

use PDO;

class User
{
    private static $pdo;

    private $id = null;
    private $name;
    private $email;
    private $password;
    private $foto = null;
    private $createdAt = null;

    // =========================
    // Conexão
    // =========================
    public static function setConnection(PDO $pdo)
    {
        self::$pdo = $pdo;
    }

    // =========================
    // Construtor
    // =========================
    public function __construct($name, $email, $password, $foto = null)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        $this->foto = $foto;
        $this->createdAt = date('Y-m-d H:i:s');
    }

    // =========================
    // CREATE
    // =========================
    public function save()
    {
        if ($this->id === null) {
            $sql = "INSERT INTO users (name, email, password, foto, created_at)
                    VALUES (:name, :email, :password, :foto, :created_at)";

            $stmt = self::$pdo->prepare($sql);
            $stmt->execute([
                ':name' => $this->name,
                ':email' => $this->email,
                ':password' => $this->password,
                ':foto' => $this->foto,
                ':created_at' => $this->createdAt
            ]);

            $this->id = self::$pdo->lastInsertId();
        } else {
            $this->update();
        }

        return $this;
    }

    // ===============
    // READ (por email)
    // ===============
    public static function findByEmail(string $email) {
        $stmt = self::$pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute([':email' => $email]);

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            return null;
        }

        $user = new self(
            $data['name'],
            $data['email'],
            $data['password'],
            $data['foto']
        );

        $user->id = $data['id'];
        $user->createdAt = $data['created_at'];

        return $user;
    }

    // =========================
    // READ (por ID)
    // =========================
    public static function find(int $id)
    {
        $stmt = self::$pdo->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute([':id' => $id]);

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            return null;
        }

        $user = new self(
            $data['name'],
            $data['email'],
            $data['password'],
            $data['foto']
        );

        $user->id = $data['id'];
        $user->createdAt = $data['created_at'];

        return $user;
    }

    // =========================
    // READ (todos)
    // =========================
    public static function all()
    {
        $stmt = self::$pdo->query("SELECT * FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // =========================
    // Verify password
    // =========================
    public function verifyPassword(string $password): bool
    {
        return password_verify($password, $this->password);
    }

    // =========================
    // UPDATE
    // =========================
    private function update()
    {
        $sql = "UPDATE users 
                SET name = :name,
                    email = :email,
                    foto = :foto
                WHERE id = :id";

        $stmt = self::$pdo->prepare($sql);

        $stmt->execute([
            ':name' => $this->name,
            ':email' => $this->email,
            ':foto' => $this->foto,
            ':id' => $this->id
        ]);
    }

    // =========================
    // DELETE
    // =========================
    public function delete()
    {
        if ($this->id === null) {
            return false;
        }

        $stmt = self::$pdo->prepare("DELETE FROM users WHERE id = :id");
        return $stmt->execute([':id' => $this->id]);
    }

    // =========================
    // Getters
    // =========================
    public function getId() { return $this->id; }
    public function getName() { return $this->name; }
    public function getEmail() { return $this->email; }
}