<?php

namespace App\services;

use App\Lib\CRUDService;
use App\Models\card;
use Illuminate\Database\Eloquent\Model;

class cardService extends CRUDService
{
    public function getModel(): Model
    {
        return new card();
    }
}
