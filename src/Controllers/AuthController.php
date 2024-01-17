<?php

namespace App\Controllers;

use App\Core\Router\Request;
use App\Core\Template\View;
use App\Models\Exceptions\Auth\AuthException;
use App\Models\User;
use DateTime;

class AuthController extends Controller
{
    public function __construct(Request $request)
    {
        parent::__construct($request);

        User::forgetMe($request->cookie(), $request->session());
    }

    public function signUp()
    {
        return $this->response->setBody(View::render('auth.register', [
            'title' => 'Register',
            'request' => $this->request,
        ]));
    }

    public function register()
    {
        $data = $this->request->get();

        if(User::validate($data)) {
            $user = User::register($data);
            $this->request->session()->set('new_user', $user);

            $this->response->redirect('/');
        }

        return $this->response->setBody(View::render('auth.register', [
            'title' => 'Register',
            'request' => $this->request,
        ]));
    }

    public function verify()
    {
        $token = $this->request->get('token');
        $user = User::find('remember_token', $token);

        $now = new DateTime();

        User::patch([
            'email_verified_at' => $now->format('Y-m-d H:i:s'),
            'remember_token' => null,
            'remember_token_valid_until' => null
        ], [
            'id' => $user->id
        ]);

        return $this->response->setBody(View::render('auth.verifying', [
            'title' => 'Email verifying',
            'user' => $user
        ]));
    }

    public function signIn()
    {
        return $this->response->setBody(View::render('auth.login', [
            'title' => 'Login',
            'request' => $this->request,
            'message' => null,
        ]));
    }

    public function login()
    {
        $username = $this->request->get('username');
        $password = $this->request->get('password');
        $remember = ($this->request->get('remember') ? true : false);

        try {
            $user = User::login($username, $password, $remember);

            if($user) {
                $this->request->session()->set('user', $user);
                $this->response->redirect('/');
            }
        }
        catch(AuthException $e) {
            $message = $e->getMessage();
        }

        return $this->response->setBody(View::render('auth.login', [
            'title' => 'Login',
            'request' => $this->request,
            'message' => ($message ?? null)
        ]));
    }

    public function logout()
    {
        $this->response->redirect('/login');
    }

}