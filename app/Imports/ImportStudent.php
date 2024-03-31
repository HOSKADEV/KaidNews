<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\Test;
use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class ImportStudent implements ToModel, WithHeadingRow,WithCustomCsvSettings
{
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

        $student = new Student([
            'firstname_ar' =>$row['alasm_balaarby'],
            'firstname_fr' =>$row['alasm_balfrnsy'],
            'lastname_ar' =>$row['allkb_balaarby'],
            'lastname_fr' =>$row['allkb_balfrnsy'],
            // 'gender' =>$row['gender'],
            'gender' => $row['algns'] == 'ذكر' ? 1 : 0 ,
            'birthday' =>\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tarykh_almylad']),
            'state_of_birth' =>$row['olay_almylad'],
            'place_of_birth' =>$row['mkan_almylad'],

            'group' =>$row['alfog'],
            'registration_number' =>$row['rkm_altsgyl'],
            'residence' =>$row['alakam'],
            'batch' =>$row['aldfaa'],
            'start_date' =>\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tarykh_bday_altrbs']),
            'end_date' =>\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tarykh_nhay_altrbs']),

            'phone' =>$row['rkm_alhatf'],
            'email' =>$row['alamyl'],
            'password' =>$row['rkm_altsgyl'],
        ]);
        $student->save();

        // $point = new Test([
        //     'student_id' => $student->id,
        //     'subject_id' => 2,
        //     'rate' => $row[2],
        //     // Add more fields as needed
        // ]);
        // $point->save();

        return $student;
    }
}
