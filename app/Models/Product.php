<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected static function booted()
    {
        parent::booted();

        static::addGlobalScope('orderByPrice', function($builder){
            $builder->orderBy('price', 'asc');
        });
    }

    protected $fillable = [
        'name',
        'url',
        'description',
        'category_id',
        'price'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
