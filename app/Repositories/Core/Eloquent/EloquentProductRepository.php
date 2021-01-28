<?php


namespace App\Repositories\Core\Eloquent;


use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Core\BaseEloquentRepository;

class EloquentProductRepository extends BaseEloquentRepository implements ProductRepositoryInterface
{
    public function search($data)
    {
        $name = $data['name'] ?? null;
        $url = $data['url'] ?? null;
        $description = $data['description'] ?? null;
        $category = $data['category_id'] ?? null;

        return $this->entity->where(function($builder) use($name, $url, $description, $category){
            if($name){
                $builder->where('name', $name);
            }

            if($url){
                $builder->orWhere('url', $url);
            }

            if($description){
                $builder->orWhere('description', 'LIKE', "%{$description}%");
            }

            if($category){
                $builder->orWhere('category_id', $category);
            }

        })
            ->with('category')
            ->orderBy('id', 'desc')
            ->paginate();
    }

    protected function resolveEntity(): string
    {
        return Product::class;
    }

}
