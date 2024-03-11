<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\AdminTableSeeder;
use Database\Seeders\StudentTableSeeder;
use Database\Seeders\TeacherTableSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(30)->create();
        $this->call([
            AdminTableSeeder::class,
            TeacherTableSeeder::class,
            StudentTableSeeder::class,
        ]);
    }
}
