<?php

namespace App\Models;

class User
{

    private $id;
    private $name;
    private $email;
    private $password;
    private $created_at;

    public function __construct($name = '', $email = '', $password = '', $created_at = '')
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->created_at = $created_at;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getCreatedAt(): string
    {
        return $this->created_at;
    }


    
}
