<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
        'name' => 'Test User',
        'username' => 'Bigus Dickus',
        'email'=> 'test@example.com'
        ]);

       $categorries = ['Technology', 'Health', 'Travel', 'Education', 'Food'];

       foreach($categorries as $category){
        Category::create (['name' => $category]);
       }
       //Post::factory(100)->create();

       
    }
}
