<?php


namespace App\Repositories\Core;


use App\Repositories\Contracts\RepositoryInterface;

abstract class BaseEloquentRepository implements RepositoryInterface
{
    protected $entity;

    /**
     * BaseEloquentRepository constructor.
     */
    public function __construct()
    {
        $this->entity = app($this->resolveEntity());
    }

    public function getAll()
    {
        return $this->entity->get();
    }

    public function findById($id)
    {
        return $this->entity->find($id);
    }

    public function findWhere($column, $valor)
    {
        return $this->entity->where($column, $valor)->get();
    }

    public function findWhereFirst($column, $valor)
    {
        return $this->entity->where($column, $valor)->first();
    }

    public function paginate($totalPage = 10)
    {
        return $this->entity->paginate($totalPage);
    }

    public function create(array $attributes)
    {
        return $this->entity->create($attributes);
    }

    public function update($id, array $attributes)
    {
        $entity = $this->findById($id);
        return $entity->update($attributes);
    }

    public function delete($id)
    {
        $this->entity->find($id)->delete();
    }

    public function with(...$callback): BaseEloquentRepository
    {
        $this->entity = $this->entity->with($callback);

        return $this;
    }

    public function orderBy($column, $order = 'ASC'): BaseEloquentRepository
    {
        $this->entity = $this->entity->orderBy($column, $order);
        return $this;
    }


    protected abstract function resolveEntity();
}
