<?php


namespace App\Repositories\Core;


use App\Repositories\Contracts\RepositoryInterface;
use Illuminate\Database\DatabaseManager as DB;

abstract class BaseQueryBuilderRepository implements RepositoryInterface
{
    private string $table;
    protected $db;
    protected $orderBy = [
        'column' => 'id',
        'order' => 'ASC'
    ];

    public function __construct(DB $db){
        $this->table = $this->table();
        $this->db = $db;
    }

    public function getAll()
    {
        return $this->db->table($this->table)->orderBy($this->orderBy['column'], $this->orderBy['order'])->get();
    }

    public function findById($id)
    {
        return $this->db->table($this->table)->find($id);
    }

    public function findWhere($column, $valor)
    {
        return $this->db->table($this->table)->where($column, $valor)
            ->get();
    }

    public function findWhereFirst($column, $valor)
    {
        return $this->db->table($this->table)->where($column, $valor)
            ->first();
    }

    public function paginate($totalPage = 10)
    {
        return $this->db->table($this->table)->orderBy($this->orderBy['column'], $this->orderBy['order'])->paginate();
    }

    public function create(array $attributes)
    {
        return $this->db->table($this->table)->insert($attributes);
    }

    public function update($id, array $attributes)
    {
        return $this->db->table($this->table)->where('id', $id)->update($attributes);
    }

    public function delete($id)
    {
        return $this->db->table($this->table)->where('id', $id)->delete();
    }

    public function orderBy($column, $order = 'ASC')
    {
        $this->orderBy['column'] = $column;
        $this->orderBy['order'] = $order;
        return $this;
    }


    protected abstract function table();
}
