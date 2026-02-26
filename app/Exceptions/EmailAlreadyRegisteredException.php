<?php

namespace App\Exceptions;

use Exception;

class EmailAlreadyRegisteredException extends Exception
{
    public function __construct(string $email)
    {
        // Modal de aviso
        
    }
}
