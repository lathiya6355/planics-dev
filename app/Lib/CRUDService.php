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

    public function delete($id) {
        return $this->getModel()::where($id)->delete();
    }

    public function create($result) {
        return $this->getModel()::create($result);
    }

    public function update($id , $result) {
        $model = $this->getModel()::findOrFail($id);
        return $model->update($result);
    }
}
