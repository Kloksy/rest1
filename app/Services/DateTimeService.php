<?php 

namespace App\Services;

class DateTimeService
{
    public static function getUserTime($userTimezone = null)
    {
        return $userTimezone 
            ? now()->setTimezone($userTimezone)
            : now();
    }

    public static function validateRatingInputs(&$min, &$max)
    {
        $min = is_numeric($min) ? (float)$min : 0;
        $max = is_numeric($max) ? (float)$max : 5;

        if ($min > $max) {
            [$min, $max] = [$max, $min];
        }
    }
}