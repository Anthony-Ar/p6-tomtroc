<?php
declare(strict_types = 1);

namespace App\Exception;

use Exception;

class BookNotFoundException extends Exception
{
    public function __construct(string $message = "", int $code = 404) {
        parent::__construct($message, $code);
    }
}
