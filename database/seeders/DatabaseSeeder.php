<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ville;
use App\Models\Etudiant;
use App\Models\User;
use App\Models\Article;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Ville::factory()->count(10)->create();
        Etudiant::factory()->count(100)->create();
        User::factory()->count(100)->create();
        Article::factory()->count(100)->create();

    }
}
