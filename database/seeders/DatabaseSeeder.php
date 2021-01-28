<?php

namespace Database\Seeders;

use App\Models\{Category, Product, User};
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if(User::count() == 0) User::factory()->create(['email' => 'local@local.com']);
         User::factory(rand(33, 57))->create();

        Category::factory(rand(20, 40))->create();
        Product::factory(rand(20, 40))->create();
    }
}
