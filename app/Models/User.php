<?php

namespace App\Models;

class User
{

    private $id = null;
    private $name;
    private $email;
    private $password;
    private $foto = null;
    private $createdAt = null;


    public function __construct($name, $email, $password)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->createdAt = date('Y-m-d H:i:s');
    }

    public static function fromArray($data)
    {
        $user = new User($data['name'], $data['email'], $data['password']);
        $user->id = $data['id'] ?? null;
        $user->foto = $data['foto'] ?? null;
        $user->createdAt = $data['created_at'] ?? null;
        return $user;
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }

    // Getters e Setters

    public function getId()
    {
        return $this->id;
    }

    public function getEmail()
    {
        return $this->email;
    }
}
