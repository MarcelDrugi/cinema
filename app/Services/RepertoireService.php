<?php

namespace App\Services;

use Carbon\Carbon;

class RepertoireService
{
    private function daysGenerator($today) {
        $weekDays = [
            0 => 'Sunday',
            1 => 'Monday',
            2 => 'Tuesday',
            3 => 'Wednesday',
            4 => 'Thursday',
            5 => 'Friday',
            6 => 'Saturday',
        ];
        
        $i = 0;
        $days = array();
        while($i < 7) {
            $days[] = $weekDays[$today];
            $today = $today >= 6 ? 0 : $today += 1;
            $i++;
        }
        return $days;
    }
    public function weekDays()
    {
        $dayOfTheWeek = Carbon::now()->dayOfWeek;
        
        return $this->daysGenerator($dayOfTheWeek);
    }
}
