<?php
return [
    [
        'uri' => '/',
        'method' => 'get',
        'controller' => \App\Controllers\PostController::class,
        'action' => 'index'
    ],
    [
        'uri' => '/register',
        'method' => 'get',
        'controller' => \App\Controllers\AuthController::class,
        'action' => 'signUp'
    ],
    [
        'uri' => '/register',
        'method' => 'post',
        'controller' => \App\Controllers\AuthController::class,
        'action' => 'register'
    ],
    [
        'uri' => '/verify/:token',
        'method' => 'get',
        'controller' => \App\Controllers\AuthController::class,
        'action' => 'verify'
    ],
    [
        'uri' => '/login',
        'method' => 'get',
        'controller' => \App\Controllers\AuthController::class,
        'action' => 'signIn'
    ],
    [
        'uri' => '/login',
        'method' => 'post',
        'controller' => \App\Controllers\AuthController::class,
        'action' => 'login'
    ],
    [
        'uri' => '/logout',
        'method' => 'post',
        'controller' => \App\Controllers\AuthController::class,
        'action' => 'logout'
    ],
    [
        'uri' => '/posts',
        'method' => 'get',
        'controller' => \App\Controllers\PostController::class,
        'action' => 'index'
    ],
    [
        'uri' => '/posts/create',
        'method' => 'get',
        'controller' => \App\Controllers\PostController::class,
        'action' => 'create'
    ],
    [
        'uri' => '/posts/create',
        'method' => 'post',
        'controller' => \App\Controllers\PostController::class,
        'action' => 'store'
    ],
    [
        'uri' => '/topics',
        'method' => 'get',
        'controller' => \App\Controllers\TopicController::class,
        'action' => 'index'
    ],
    [
        'uri' => '/topics/create',
        'method' => 'post',
        'controller' => \App\Controllers\TopicController::class,
        'action' => 'store'
    ],
    [
        'uri' => '/topics/:topic/delete',
        'method' => 'post',
        'controller' => \App\Controllers\TopicController::class,
        'action' => 'delete'
    ]
];