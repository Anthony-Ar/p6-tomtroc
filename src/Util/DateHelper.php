<?php

namespace App\Util;

use DateMalformedStringException;
use DateTime;

class DateHelper
{
    /**
     * Retourne la différence en nombre d'années entre deux dates
     * @param DateTime|string $date
     * @return int
     * @throws DateMalformedStringException
     */
    public static function yearSinceDate(DateTime|string $date) : int
    {
        if (!$date instanceof DateTime) {
            $date = new DateTime($date);
        }

        return $date->diff(new DateTime())->y;
    }

    public static function showHoursOrDays(DateTime|string $date) : string
    {
        if (!$date instanceof DateTime) {
            $date = new DateTime($date);
        }

        if($date->diff(new DateTime())->d >= 1){
            return $date->format('d.m');
        }

        return $date->format('H:i');
    }
}
