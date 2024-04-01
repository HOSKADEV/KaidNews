<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subject::create([
            'name'=> 'المواضبة على الحضور',
            'coef'=> '2',
        ]);

        Subject::create([
            'name'=> 'كمية المشاركة',
            'coef'=> '1',
        ]);

        Subject::create([
            'name'=> 'جودة المشاركة',
            'coef'=> '2',
        ]);

        Subject::create([
            'name'=> 'روح المبادرة',
            'coef'=> '1',
        ]);

        Subject::create([
            'name'=> 'الحضور الذهني',
            'coef'=> '2',
        ]);

        Subject::create([
            'name'=> 'القيم الأخلاقية',
            'coef'=> '2',
        ]);

        Subject::create([
            'name'=> 'الهندام',
            'coef'=> '1',
        ]);
        Subject::create([
            'name'=> 'العلاقة الإنسانية و التفاعل مع الفريق',
            'coef'=> '1',
        ]);

        Subject::create([
            'name'=> 'اعمال المعارف التطبيقية و قدرة العمل',
            'coef'=> '6',
        ]);
        Subject::create([
            'name'=> 'اختبار نهاية التربص',
            'coef'=> '2',
        ]);
    }
}
