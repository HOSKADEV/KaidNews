<?php

namespace Database\Seeders;

use App\Models\TypesOfExpenses;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeOfExpensesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TypesOfExpenses::create([
          'expenses_id' => 1,
          'name' => 'رئيس التحرير',
          'created_at' => now(),
          'updated_at' => now(),
        ]);

        TypesOfExpenses::create([
          'expenses_id' => 1,
          'name' => 'الإدارة و الشؤون العامة',
          'created_at' => now(),
          'updated_at' => now(),
        ]);

        TypesOfExpenses::create([
          'expenses_id' => 1,
          'name' => 'مركب حضوريا',
          'created_at' => now(),
          'updated_at' => now(),
        ]);
        TypesOfExpenses::create([
          'expenses_id' => 1,
          'name' => 'مركب عن بعد البياضة',
          'created_at' => now(),
          'updated_at' => now(),
        ]);
        TypesOfExpenses::create([
          'expenses_id' => 1,
          'name' => 'مكلفة بالوسائط المتعددة التفاعلية',
          'created_at' => now(),
          'updated_at' => now(),
        ]);
        TypesOfExpenses::create([
          'expenses_id' => 1,
          'name' => 'توسيع انتشار المحتوى عبر الملتمديا',
          'created_at' => now(),
          'updated_at' => now(),
        ]);
        TypesOfExpenses::create([
          'expenses_id' => 1,
          'name' => 'منسقة المحتوى',
          'created_at' => now(),
          'updated_at' => now(),
        ]);
        TypesOfExpenses::create([
          'expenses_id' => 1,
          'name' => 'محررة  صفحية',
          'created_at' => now(),
          'updated_at' => now(),
        ]);
        TypesOfExpenses::create([
          'expenses_id' => 1,
          'name' => 'عاملة نظافة',
          'created_at' => now(),
          'updated_at' => now(),
        ]);

        TypesOfExpenses::create([
          'expenses_id' => 2,
          'name' => 'فاتورة  الكهرباء',
          'created_at' => now(),
          'updated_at' => now(),
        ]);
        TypesOfExpenses::create([
          'expenses_id' => 2,
          'name' => 'فاتورة الماء',
          'created_at' => now(),
          'updated_at' => now(),
        ]);
        TypesOfExpenses::create([
          'expenses_id' => 2,
          'name' => 'الأنترنت + الهاتف الثابت +الهاتف النقال',
          'created_at' => now(),
          'updated_at' => now(),
        ]);
        TypesOfExpenses::create([
          'expenses_id' => 2,
          'name' => 'زيد للمطافئ',
          'created_at' => now(),
          'updated_at' => now(),
        ]);
        TypesOfExpenses::create([
          'expenses_id' => 2,
          'name' => 'ص.ب',
          'created_at' => now(),
          'updated_at' => now(),
        ]);
        TypesOfExpenses::create([
          'expenses_id' => 2,
          'name' => 'تغذية صندوق المصاريف',
          'created_at' => now(),
          'updated_at' => now(),
        ]);
        TypesOfExpenses::create([
          'expenses_id' => 2,
          'name' => 'الاشهار الثنائي',
          'created_at' => now(),
          'updated_at' => now(),
        ]);
        TypesOfExpenses::create([
          'expenses_id' => 2,
          'name' => 'بطاقة بايسيرا',
          'created_at' => now(),
          'updated_at' => now(),
        ]);

        TypesOfExpenses::create([
          'expenses_id' => 3,
          'name' => 'مكتبة ميسة فارس',
          'created_at' => now(),
          'updated_at' => now(),
        ]);
        TypesOfExpenses::create([
          'expenses_id' => 3,
          'name' => 'مطعم البادية',
          'created_at' => now(),
          'updated_at' => now(),
        ]);

    }
}
