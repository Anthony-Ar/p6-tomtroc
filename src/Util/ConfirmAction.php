<?php

namespace App\Util;

class ConfirmAction
{
    public static function askConfirmation(string $message) : string
    {
        return "onclick=\"return confirm('$message');\"";
    }
}
