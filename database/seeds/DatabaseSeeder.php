<?php

use App\Models\Category;
use App\Models\Product;
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
        // $this->call(UsersTableSeeder::class);
        // factory(Category::class, 20)->create();
        // factory(Category::class, 10)->create([
        //     'parent_id' => $this ->getRandomParentId()
        // ]);
        factory(Product::class, 20)->create();
    }

    private function getRandomParentId()
    {
       $parent_id = Category::inRandomOrder()->first();
       return $parent_id;
    }
}
