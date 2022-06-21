<?php

namespace App\Repositories;

abstract class BaseRepositories
{
    protected $query;

    public function applyPagination(): void
    {
        $this->query->paginate();
    }
    public abstract function getById($Id, $conditions);
    public abstract function filter($conditions);
    public abstract function create($data);
    public abstract function update($data);
}
