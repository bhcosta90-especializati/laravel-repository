<?php

namespace App\Repositories\Contracts;


interface RepositoryInterface {
    public function getAll();

    public function findById($id);

    public function findWhere($column, $valor);

    public function findWhereFirst($column, $valor);

    public function paginate($totalPage = 10);

    public function create(array $attributes);

    public function update($id, array $attributes);

    public function delete($id);

    public function orderBy($column, $order='ASC');
}
