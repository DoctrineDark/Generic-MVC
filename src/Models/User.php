<?php

namespace App\Models;

use App\Models\Traits\Authenticatable;

class User extends Model
{
    use Authenticatable;

    protected static $table = 'users';

    protected static $primaryKey = 'id';
}