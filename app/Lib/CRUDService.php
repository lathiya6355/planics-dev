<?php

namespace App\Lib;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

abstract class CRUDService
{
    abstract function getModel(): Model;

    public function getAll(): Collection
    {
        return $this->getModel()::get();
    }

    public function getById(int $id): Model
    {
        return $this->getModel()::findOrFail($id);
    }

    public function create($result): Model
    {
        return $this->getModel()::create($result);
    }

    public function delete($id): bool
    {
        return $this->getModel()::where($id)->delete();
    }

    public function update($id, $result) : bool
    {
        $model = $this->getModel()::findOrFail($id);
        return $model->update($result);
    }

    public function link($result) {
        return url('/' . $result['action_link']);
    }
}
