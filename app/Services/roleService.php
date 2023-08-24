<?php

namespace App\services;

use App\Lib\CRUDService;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class roleService extends CRUDService
{
    public function getModel(): Model
    {
        return new Role();
    }
}
