<?php

namespace App\Util;

class TextTruncator
{
    /**
     * Permet de couper un texte en fonction d'un nombre de caractères
     * @param string $text
     * @param int $limit
     * @param string $suffix
     * @return string
     */
    public static function truncate(string $text, int $limit = 80, string $suffix = "...") : string
    {
        if(strlen($text) > $limit) {
            $text = substr($text, 0, $limit) . $suffix;
        }

        return $text;
    }
}
