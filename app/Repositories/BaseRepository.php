<?php

namespace App\Repositories;


use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
        $this->nextId = 0;
        $this->perPage = config('enums.perPage');
    }

    public function getAll()
    {
        return $this->model->orderBy('id', 'DESC')->get();
    }

    public function getById($id)
    {
        return $this->model->where('id', $id)->first();
    }

    public function getPaginated($page)
    {
        return $this->model->orderBy('id', 'DESC')->paginate($page);
    }
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(array $data, $id)
    {
        $result = $this->getById($id);
        $result->fill($data);
        return $result->push();
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }


}
