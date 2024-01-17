<?php


namespace App\Models\Exceptions\Auth;


class UnverifiedEmailException extends AuthException
{
    protected $message = 'Your email is not verified.';
}