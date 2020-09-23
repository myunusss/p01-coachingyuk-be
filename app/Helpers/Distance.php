<?php

namespace App\Helpers;

class Distance
{
    public static function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        $R = 3440.0;
        $dLat = deg2Rad($lat2 - $lat1);
        $dLong = deg2Rad($lon2 - $lon1);
        $a = sin($dLat / 2) * sin($dLat / 2) +
            cos(deg2Rad($lat1)) * cos(deg2Rad($lat2)) * sin($dLong / 2) * sin($dLong / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        return $R * $c * 1852.0;
    }
}
