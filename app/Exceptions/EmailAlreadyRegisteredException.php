<?php

namespace App\Exceptions;

use Exception;

class EmailAlreadyRegisteredException extends Exception
{
    public function __construct(string $email)
    {
        parent::__construct("O email '{$email}' já está registrado.");
    }
}
