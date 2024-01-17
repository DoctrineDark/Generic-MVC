<?php

namespace App\Models\Traits;

use App\Core\Cookie\Cookie;
use App\Core\Session\Session;
use App\Models\Exceptions\Auth\InvalidCredentialsException;
use App\Models\Exceptions\Auth\UnverifiedEmailException;

trait Authenticatable
{
    private static $rememberToken = 'remember_token';

    public static function validate(array $data) : bool
    {
        return true;
    }

    public static function register(array $data)
    {
        $attributes = [
            'username',
            'email',
            'name',
            'last_name',
        ];

        $filtered = array_filter($data, function($key) use($attributes) {
            return in_array($key, $attributes);
        }, ARRAY_FILTER_USE_KEY);

        $filtered['password'] = static::encrypt($data['password']);
        $filtered['remember_token'] = static::encrypt(rand());

        return static::create($filtered);
    }

    public static function login(string $username, string $password, bool $remember)
    {
        $password = static::encrypt($password);
        $date = new \DateTime();
        $date->modify('+1 month');
        $table = static::$table;
        $user = static::query("SELECT * FROM $table WHERE (username = ? OR email = ?) AND password = ?", [$username, $username, $password])->fetch();

        if($user) {
            if(!$user->email_verified_at) {
                throw new UnverifiedEmailException();
            }

            if($remember) {
                $rememberToken = static::encrypt(rand());

                static::patch([
                    'remember_token' => $rememberToken,
                    'remember_token_valid_until' => $date->format('Y-m-d H:i:s')
                ], [
                    static::$primaryKey => $user->id
                ]);

                $cookie = new Cookie();
                $cookie->set(static::$rememberToken, $rememberToken, (30*24));
            }

            return $user;
        }

        throw new InvalidCredentialsException();
    }

    public static function encrypt(string $string) : string
    {
        return sha1($string);
    }

    public static function bringMeBack(Cookie $cookie,  Session $session)
    {
        $token = $cookie->get(static::$rememberToken);

        if($token) {
            $user = static::find(static::$rememberToken, $token);
            $now = new \DateTime();

            if($user && ($user->remember_token_valid_until > $now->format('Y-m-d H:i:s'))) {
                $session->set('user', $user);
            }
        }
    }

    public static function forgetMe(Cookie $cookie, Session $session)
    {
        $cookie->delete(static::$rememberToken);
        $session->destroy();
    }
}