<?php

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
         $this->call(LaratrustSeeder::class);
     factory(App\Blog::class, 50)->create();
    factory(App\Category::class, 50)->create();
         factory(App\Tag::class, 50)->create();
    }
}
