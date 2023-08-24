<?php

namespace App\Lib;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

abstract class CRUDService
{
    abstract function getModel(): Model;

    public function getAll()
    {
        return $this->getModel()::all();
    }

    public function getById(int $id) : Model {
        return $this->getModel()::findOrFail($id);
    }

    public function delete(int $id) {
        return $this->getModel()::whereId($id)->delete();
    }
}
