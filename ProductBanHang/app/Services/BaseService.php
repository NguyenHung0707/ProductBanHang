<?php

namespace App\Services;

class BaseService implements ServiceInterface
{
    public $reponsitory;

    public function all()
    {
      return $this->reponsitory->all();
    }

    public function find(int $id)
    {
        return $this->reponsitory->find($id);

    }

    public function create(array $data)
    {
        return $this->reponsitory->create($data);

    }

    public function update(array $data, $id)
    {
        return $this->reponsitory->update($data, $id);

    }

    public function delete($id)
    {
        return $this->reponsitory->delete($id);

    }

    public function  searchAndPaginate($searchBy, $keyword, $perPage = 5)
    {
        return $this->reponsitory->searchAndPaginate($searchBy, $keyword, $perPage);
    }


}
