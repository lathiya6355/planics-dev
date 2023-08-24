<?php

namespace App\services;

use App\Lib\CRUDService;
use App\Models\herosection;
use Illuminate\Database\Eloquent\Model;

class heroService extends CRUDService
{
    public function getModel(): Model
    {
        return new herosection();
    }
}
