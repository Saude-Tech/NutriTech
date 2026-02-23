<?php
namespace App\Exceptions;

use Exception;

class InvalidCredentialsException extends Exception
{
    public function __construct()
    {
        parent::__construct("Credenciais inválidas. Verifique seu email e senha.");
    }
}
