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
}
