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
        $this->perPage = config('enum.perPage');
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

    public function getPaginatedByFilterAndNextId($filter, $nextId, $memberId = null)
    {
        $getAll = $this->model->filter($filter)->where(function ($query) use ($nextId, $memberId) {
            if ($nextId != 0) {
                $query->where('id', '<=', $nextId);
            }
            if ($memberId != null) {
                $query->where('member_id', $memberId);
            }
        })->orderBy('id', 'DESC')->limit($this->perPage + 1)->get();
        $totalCount = $getAll->count();
        if ($totalCount > $this->perPage) {
            $this->nextId = $getAll[$this->perPage]->id;
            unset($getAll[$totalCount - 1]);
        } else {
            $this->nextId = null;
        }

        return ['data' => $getAll, 'nextId' => $this->nextId];
    }


}
