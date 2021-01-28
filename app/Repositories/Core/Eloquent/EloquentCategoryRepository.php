<?php


namespace App\Repositories\Core\Eloquent;


use App\Models\Category;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Core\BaseEloquentRepository;

class EloquentCategoryRepository extends BaseEloquentRepository implements CategoryRepositoryInterface
{
    protected function resolveEntity(): string
    {
        return Category::class;
    }

    public function search(array $data)
    {
        $name = $data['name'] ?? null;
        $url = $data['url'] ?? null;
        $description = $data['description'] ?? null;

        return $this->entity->where(function($builder) use($name, $url, $description){
            if($name){
                $builder->where('name', $name);
            }

            if($url){
                $builder->orWhere('url', $url);
            }

            if($description){
                $builder->orWhere('description', 'LIKE', "%{$description}%");
            }

        })
            ->orderBy('id', 'desc')
            ->paginate();
    }


}
