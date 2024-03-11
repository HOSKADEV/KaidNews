<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeacherTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Teacher::create([
            'firstname_ar'  => 'مراد',
            'lastname_ar'   => 'لوكام',
            'firstname_fr'  => 'Mourad',
            'lastname_fr'   => 'Loukam',
            'phone'   => '0775805472',
            'email'   => 'loukam@prof.com',
            'password' => '123456789',

            'gender'     => 1,
            'birthday'   => '1975-08-23',
            'address' => "Alg"
        ]);
    }
}
