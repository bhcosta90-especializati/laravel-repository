<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected static function booted()
    {
        parent::booted();

        static::saving(function($obj){
            $obj->url = Str::kebab($obj->name);
        });
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
