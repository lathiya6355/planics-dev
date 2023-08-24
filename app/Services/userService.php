<?php

namespace App\services;

use App\Lib\CRUDService;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class userService extends CRUDService
{
    public function getModel(): Model
    {
        return new User();
    }
}
