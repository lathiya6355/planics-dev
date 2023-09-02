<?php

namespace App\services;

use App\Lib\CRUDService;
use App\Models\cardSection;
use Illuminate\Database\Eloquent\Model;

class cardSectionService extends CRUDService
{
    public function getModel(): Model
    {
        return new cardSection();
    }
}
