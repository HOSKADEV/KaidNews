<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\Test;
use App\Models\Student;
use App\Models\Subject;
use App\Traits\DaysTrait;
use App\Models\Attendence;
use App\Models\User;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class ImportStudent implements ToModel, WithHeadingRow, WithCustomCsvSettings
{
    use DaysTrait;


    public function getCsvSettings(): array
    {
        return [
            'input_encoding' => 'UTF-8',
            'delimiter' => ',',
            'enclosure' => '"',
            'escape_character' => '\\',
            // 'to_encoding' => 'UTF-8',
        ];
    }
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function model(array $row)
    {

      dd($row);
        // dd($row);

        $student =  Student::create([
            'firstname_ar' => $row['alasm_balaarby'] == null ? 'non' :$row['alasm_balaarby'],
            'firstname_fr' => $row['alasm_balfrnsy'] == null ? 'non' :$row['alasm_balfrnsy'],
            'lastname_ar' => $row['allkb_balaarby'] == null ? 'non' :$row['allkb_balaarby'],
            'lastname_fr' => $row['allkb_balfrnsy'] == null ? 'non' :$row['allkb_balfrnsy'],
            // 'gender' =>$row['gender'],
            'gender' => $row['algns'] == 'ذكر' ? 1 : 0,
            // 'birthday' => $row['tarykh_almylad'],
            'birthday' => date('Y-m-d H:i:s' , strtotime($row['tarykh_almylad'])),

            //
            'state_of_birth' => $row['olay_almylad']== null ? 'non' :$row['olay_almylad'],
            'place_of_birth' => $row['mkan_almylad']== null ? 'non' :$row['mkan_almylad'],

            'group' => $row['alfog']== null ? 'non' :$row['alfog'],
            'registration_number' => $row['rkm_altsgyl']== null ? Str::random(10):$row['rkm_altsgyl'],
            'residence' => $row['alakam']== null ? 'non' :$row['alakam'],
            'batch' => $row['aldfaa']== null ? 'non' :$row['aldfaa'],
            'start_date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tarykh_bday_altrbs']),
            'end_date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tarykh_nhay_altrbs']),

            'phone' => $row['rkm_alhatf']== null ? Str::random(10) :$row['rkm_alhatf'],
            'email' => $row['alamyl']== null ? Str::random(10) :$row['alamyl'],
            'password' => $row['rkm_altsgyl']== null ? 'non' :$row['rkm_altsgyl'],
            'moyenFinal' => '0',
            'created_by' => auth('admin')->id(),
        ]);

        // $st = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tarykh_bday_altrbs']);
        // $end = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tarykh_nhay_altrbs']);


        // $startDate = Carbon::parse('2024/04/02');
        // $endDate = Carbon::parse('2024/04/15');


        $startDate = Carbon::parse($student->start_date);
        $endDate = Carbon::parse($student->end_date);
        $allDays = $this->getDaysFromSundayToThursdays($startDate, $endDate);

        foreach ($allDays['days'] as $key => $day) {
            Attendence::create([
                'day' => $day+1,
                'week' =>$allDays['weeks'][$key],
                'month' =>$allDays['months'][$key],
                'year' =>$allDays['years'][$key],
                'student_id' => $student->id,
                'number' => 3,
            ]);
        }
        // المواضبة على الحضور
        Test::create([
            'student_id' => $student->id,
            'subject_id' => Subject::where('name', 'المواضبة على الحضور')->first()->id,
            'rate' => $row["almoadb_aal_alhdor"]== null ? 0 :$row['almoadb_aal_alhdor'],
            'created_by' => auth('admin')->id(),
        ]);
        // كمية المشاركة
        Test::create([
            'student_id' => $student->id,
            'subject_id' => Subject::where('name', 'كمية المشاركة')->first()->id,
            'rate' => $row["kmy_almshark"]== null ? 0 :$row['kmy_almshark'],
            'created_by' => auth('admin')->id(),
        ]);

        // جودة المشاركة
        Test::create([
            'student_id' => $student->id,
            'subject_id' => Subject::where('name', 'جودة المشاركة')->first()->id,
            'rate' => $row["god_almshark"]== null ? 0 :$row['god_almshark'],
            'created_by' => auth('admin')->id(),
        ]);

        // روح المبادرة
        Test::create([
            'student_id' => $student->id,
            'subject_id' => Subject::where('name', 'روح المبادرة')->first()->id,
            'rate' => $row["roh_almbadr"]== null ? 0 :$row['roh_almbadr'],
            'created_by' => auth('admin')->id(),
        ]);

        // الحضور الذهني
        Test::create([
            'student_id' => $student->id,
            'subject_id' => Subject::where('name', 'الحضور الذهني')->first()->id,
            'rate' => $row["alhdor_althhny"]== null ? 0 :$row['alhdor_althhny'],
            'created_by' => auth('admin')->id(),
        ]);

        // القيم الأخلاقية
        Test::create([
            'student_id' => $student->id,
            'subject_id' => Subject::where('name', 'القيم الأخلاقية')->first()->id,
            'rate' => $row["alkym_alakhlaky"]== null ? 0 :$row['alkym_alakhlaky'],
            'created_by' => auth('admin')->id(),
        ]);

        // الهندام
        Test::create([
            'student_id' => $student->id,
            'subject_id' => Subject::where('name', 'الهندام')->first()->id,
            'rate' => $row["alhndam"]== null ? 0 :$row['alhndam'],
            'created_by' => auth('admin')->id(),
        ]);

        // العلاقة  الإنسانية و التفاعل مع الفريق
        Test::create([
            'student_id' => $student->id,
            'subject_id' => Subject::where('name', 'العلاقة الإنسانية و التفاعل مع الفريق')->first()->id,
            'rate' => $row["alaalak_alansany_oaltfaaal_maa_alfryk"]== null ? 0 :$row['alaalak_alansany_oaltfaaal_maa_alfryk'],
            'created_by' => auth('admin')->id(),
        ]);

        // اعمال المعارف التطبيقية و قدرة العمل
        Test::create([
            'student_id' => $student->id,
            'subject_id' => Subject::where('name', 'اعمال المعارف التطبيقية و قدرة العمل')->first()->id,
            'rate' => $row["aaamal_almaaarf_alttbyky_o_kdr_alaaml"]== null ? 0 :$row['aaamal_almaaarf_alttbyky_o_kdr_alaaml'],
            'created_by' => auth('admin')->id(),
        ]);

        // اختبار نهاية التربص
        Test::create([
            'student_id' => $student->id,
            'subject_id' => Subject::where('name', 'اختبار نهاية التربص')->first()->id,
            'rate' => $row["akhtbar_nhay_altrbs"]== null ? 0 :$row['akhtbar_nhay_altrbs'],
            'created_by' => auth('admin')->id(),
        ]);

        $student->moyenFinal = $student->moyen;
        $student->save();

        return $student;
    }
}
