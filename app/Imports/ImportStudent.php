<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\Test;
use App\Models\Student;
use App\Models\Subject;
use App\Traits\DaysTrait;
use App\Models\Attendence;
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

    

        $student =  Student::create([
            'firstname_ar' => $row['alasm_balaarby'],
            'firstname_fr' => $row['alasm_balfrnsy'],
            'lastname_ar' => $row['allkb_balaarby'],
            'lastname_fr' => $row['allkb_balfrnsy'],
            // 'gender' =>$row['gender'],
            'gender' => $row['algns'] == 'ذكر' ? 1 : 0,
            'birthday' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tarykh_almylad']),
            'state_of_birth' => $row['olay_almylad'],
            'place_of_birth' => $row['mkan_almylad'],

            'group' => $row['alfog'],
            'registration_number' => $row['rkm_altsgyl'],
            'residence' => $row['alakam'],
            'batch' => $row['aldfaa'],
            'start_date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tarykh_bday_altrbs']),
            'end_date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tarykh_nhay_altrbs']),

            'phone' => $row['rkm_alhatf'],
            'email' => $row['alamyl'],
            'password' => $row['rkm_altsgyl'],
        ]);

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
            'rate' => $row["almoadb_aal_alhdor"],
        ]);
        // كمية المشاركة
        Test::create([
            'student_id' => $student->id,
            'subject_id' => Subject::where('name', 'كمية المشاركة')->first()->id,
            'rate' => $row["kmy_almshark"],
        ]);

        // جودة المشاركة
        Test::create([
            'student_id' => $student->id,
            'subject_id' => Subject::where('name', 'جودة المشاركة')->first()->id,
            'rate' => $row["god_almshark"],
        ]);

        // روح المبادرة 
        Test::create([
            'student_id' => $student->id,
            'subject_id' => Subject::where('name', 'روح المبادرة')->first()->id,
            'rate' => $row["roh_almbadr"],
        ]);

        // الحضور الذهني
        Test::create([
            'student_id' => $student->id,
            'subject_id' => Subject::where('name', 'الحضور الذهني')->first()->id,
            'rate' => $row["alhdor_althhny"],
        ]);

        // القيم الأخلاقية
        Test::create([
            'student_id' => $student->id,
            'subject_id' => Subject::where('name', 'القيم الأخلاقية')->first()->id,
            'rate' => $row["alkym_alakhlaky"],
        ]);

        // الهندام
        Test::create([
            'student_id' => $student->id,
            'subject_id' => Subject::where('name', 'الهندام')->first()->id,
            'rate' => $row["alhndam"],
        ]);

        // العلاقة  الإنسانية و التفاعل مع الفريق
        Test::create([
            'student_id' => $student->id,
            'subject_id' => Subject::where('name', 'العلاقة الإنسانية و التفاعل مع الفريق')->first()->id,
            'rate' => $row["alaalak_alansany_oaltfaaal_maa_alfryk"],
        ]);

        // اعمال المعارف التطبيقية و قدرة العمل
        Test::create([
            'student_id' => $student->id,
            'subject_id' => Subject::where('name', 'اعمال المعارف التطبيقية و قدرة العمل')->first()->id,
            'rate' => $row["aaamal_almaaarf_alttbyky_o_kdr_alaaml"],
        ]);

        // اختبار نهاية التربص
        Test::create([
            'student_id' => $student->id,
            'subject_id' => Subject::where('name', 'اختبار نهاية التربص')->first()->id,
            'rate' => $row["akhtbar_nhay_altrbs"],
        ]);
        return $student;
    }
}
