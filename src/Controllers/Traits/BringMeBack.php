<?php

namespace App\Controllers\Traits;

use App\Core\Router\Request;
use App\Models\User;

trait BringMeBack
{
    public function __construct(Request $request)
    {
        parent::__construct($request);

        User::bringMeBack($request->cookie(), $request->session());
    }
}