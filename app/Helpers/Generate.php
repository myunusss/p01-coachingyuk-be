<?php
namespace App\Helpers;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;

class Generate
{

    public static function money($value = 0, $currency = 'Rp.')
    {
        return $currency . ' ' . number_format($value, 0, '', '.') . ',-';
    }


    public static function getFileExtension($file_name)
    {
        return pathinfo($file_name, PATHINFO_EXTENSION);
    }

    public static function parseNumber($number, $dec_point = null)
    {
        if (empty($dec_point)) {
            $locale = localeconv();
            $dec_point = $locale['decimal_point'];
        }
        return floatval(str_replace($dec_point, '.', preg_replace('/[^\d' .
        preg_quote($dec_point) . ']/', '', $number)));
    }


    public static function randomDigitsLame($numDigits)
    {
        $digits = '';

        for ($i = 0; $i < $numDigits; ++$i) {
            $digits .= mt_rand(0, 9);
        }

        return $digits;
    }

    public static function generateRandomString($length = 10)
    {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public static function generateRandomNumber($length = 10)
    {
        $characters = '1234567890';
        $charactersLength = strlen($characters);
        $randomNumber = '';
        for ($i = 0; $i < $length; $i++) {
            $randomNumber .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomNumber;
    }

    public static function maskedNumber($number, $x = 0)
    {
        $count_char = strlen($number);
        $var = substr_replace($number, str_repeat("*", $count_char - (($x + 1) * 2)), $x, $count_char -
        (( $x + 1 ) * 2));
        return $var;
    }

    public static function maskedEmail($email, $x = 0)
    {
        $a = explode('@', $email);
        $b = explode('.', $a[1]);
        $var[0] = substr_replace($a[0], str_repeat("*", strlen($a[0]) - $x), $x, strlen($a[0]) - $x);
        $var[1] = substr_replace($b[0], str_repeat("*", strlen($b[0]) - $x), $x, strlen($b[0]) - $x);
        $result = $var[0] . '@' . $var[1];
        foreach ($b as $index => $row) {
            if ($index != 0) {
                $result .= '.' . $row;
            }
        }
        return $result;
    }

    public static function initJson()
    {
        return [
            'code' => [],
            'status' => [],
            'message' => [],
            'records' => [],
            'pagination' => []
        ];
    }


    public static function uuid()
    {
        $uuid = Uuid::uuid1();
        return $uuid->toString();
    }

    public static function responseTime()
    {
        $diff = microtime(true) - session()->get('initTime');
        session()->forget('initTime');
        $sec = intval($diff);
        $micro = $diff - $sec;
        return round($micro * 1000, 4) . " ms";
    }
}
