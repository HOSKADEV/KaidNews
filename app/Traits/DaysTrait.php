<?php

namespace App\Traits;

trait DaysTrait
{

    public function getDaysFromSundayToThursdays($startDate, $endDate)
    {
        $days = [];
        $weeks = [];
        $months = [];
        $years = [];
        // Loop through each day between the start and end dates
        for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
            // Check if the current day is Sunday to Thursday (0 = Sunday, 4 = Thursday)
            if ($date->dayOfWeek >= 0 && $date->dayOfWeek <= 4) {
                $days[] =  $date->dayOfWeek;
                $weeks[] = $date->weekOfMonth;
                $months[] = $date->month;
                $years[] = $date->year;
            }
        }
        return [
            'days' => $days,
            'weeks' => $weeks,
            'months' => $months,
            'years' => $years
        ];
    }
}
