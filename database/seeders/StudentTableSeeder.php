<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StudentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Student::create([
            'firstname_ar'  => 'عبدالقادر',
            'lastname_ar'   => 'مجاجي',
            'firstname_fr'  => 'Abdelkadir',
            'lastname_fr'   => 'Medjadji',
            'gender'     => 1,
            'birthday'   => '1998-02-23',
            'state_of_birth'   => 'الشلف',
            'place_of_birth'   => 'الشلف',
            
            'registration_number' => '181832004929',
            'group' => '02',
            'residence'=> 'حي الشريف بوقادير',
            'batch'=> 'أ',
            'start_date'=> '2024-04-3',
            'end_date'=>  '2024-05-15',

            'phone'   => '0775805470',
            'email'   => 'medjadji.abdelkadir@gmail.com',
            'password' => '123456789',
        ]);
    }
}
