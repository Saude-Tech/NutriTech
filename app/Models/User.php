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
    public function __construct(
        $name, 
        $email, 
        $password, 
        $foto = null, 
        bool $isHashed = false
    ) {
        $this->name = $name;
        $this->email = $email;
        $this->password = $isHashed 
            ? $password 
            : password_hash($password, PASSWORD_DEFAULT);

        $this->foto = $foto;
        $this->createdAt = date('Y-m-d H:i:s');
    }

    // =========================
    // CREATE
    // =========================
    public function save()
    {
        if ($this->id === null) {
            $sql = "INSERT INTO users 
                    (user_name, user_email, user_password, user_foto, user_created_at)
                    VALUES 
                    (:user_name, :user_email, :user_password, :user_foto, :user_created_at)";

            $stmt = self::$pdo->prepare($sql);
            $stmt->execute([
                ':user_name' => $this->name,
                ':user_email' => $this->email,
                ':user_password' => $this->password,
                ':user_foto' => $this->foto,
                ':user_created_at' => $this->createdAt
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
        $stmt = self::$pdo->prepare("SELECT * FROM users WHERE user_email = :user_email");
        $stmt->execute([':user_email' => $email]);

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            return null;
        }

        $user = new self(
            $data['user_name'],
            $data['user_email'],
            $data['user_password'],
            $data['user_foto'],
            true // ← ESSENCIAL
        );

        $user->id = $data['user_id'];
        $user->createdAt = $data['user_created_at'];

        return $user;
    }

    // =========================
    // READ (por ID)
    // =========================
    public static function find(int $id)
    {
        $stmt = self::$pdo->prepare("SELECT * FROM users WHERE user_id = :user_id");
        $stmt->execute([':user_id' => $id]);

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            return null;
        }

        $user = new self(
            $data['user_name'],
            $data['user_email'],
            $data['user_password'],
            $data['user_foto'],
            true
        );

        $user->id = $data['user_id'];
        $user->createdAt = $data['user_created_at'];

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
                SET user_name = :user_name,
                    user_email = :user_email,
                    user_foto = :user_foto
                WHERE user_id = :user_id";

        $stmt = self::$pdo->prepare($sql);

        $stmt->execute([
            ':user_name' => $this->name,
            ':user_email' => $this->email,
            ':user_foto' => $this->foto,
            ':user_id' => $this->id
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

        $stmt = self::$pdo->prepare("DELETE FROM users WHERE user_id = :user_id");
        return $stmt->execute([':user_id' => $this->id]);
    }

    public static function fromArray(array $data): self
    {
        $user = new self(
            $data['user_name'],
            $data['user_email'],
            $data['user_password'],
            $data['user_foto'],
            true
        );

        $user->id = $data['user_id'];
        $user->createdAt = $data['user_created_at'];

        return $user;
    }

    // =========================
    // Getters
    // =========================
    public function getId() { return $this->id; }
    public function getName() { return $this->name; }
    public function getEmail() { return $this->email; }
    public function getPassword() {return $this->password;}
}