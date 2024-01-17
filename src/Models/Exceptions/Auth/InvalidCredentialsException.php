<?php

namespace App\Models\Exceptions\Auth;

class InvalidCredentialsException extends AuthException
{
    protected $message = 'Invalid username and/or password.';
}