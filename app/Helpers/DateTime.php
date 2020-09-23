<?php

namespace App\Helpers;
use Carbon\Carbon;

class DateTime
{
    public static function getDayNames($dayOfWeek)
    {
        $dayNames = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");

        return $dayNames[$dayOfWeek];
    }

    public static function getDateTime()
    {
        return Carbon::now()->format('Y-m-d H:i:s');
    }

    public static function getDateTimeInt()
    {
        return strtotime(Carbon::now()->format('Y-m-d H:i:s'));
    }

    public static function getArrayOfMonths()
    {
        return [
            '1' => 'Januari',
            '2' => 'Februari',
            '3' => 'Maret',
            '4' => 'April',
            '5' => 'Mei',
            '6' => 'Juni',
            '7' => 'July',
            '8' => 'Agustus',
            '9' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        ];
    }

    public static function getDateRangeByMonth($month, $year, $date_format = 'int')
    {
        if ($date_format == 'int') {
            $start_date = strtotime(date(Carbon::parse("1-" . $month . '-' . $year)->format('Y-m-d')));
            $end_date = strtotime(date(Carbon::parse("1-" . $month . '-' . $year)->endOfMonth()->format('Y-m-d')));
        } else {
            $start_date = Carbon::parse("1-" . $month . '-' . $year)->format($date_format);
            $end_date = Carbon::parse("1-" . $month . '-' . $year)->endOfMonth()->format($date_format);
        }
        return [
            'start_date' => $start_date,
            'end_date' => $end_date
        ];
    }

    public static function getArrayOfYearRange($year_start, $year_end)
    {
        $year = [];
        $index = 0;
        for ($i = $year_start; $i <= $year_end; $i++) {
            $year[$index] = $i;
            $index++;
        }
        return $year;
    }

    public static function formatDateTime($dateTime)
    {
        return Carbon::parse($dateTime)->format('Y-m-d H:i:s');
    }
}
