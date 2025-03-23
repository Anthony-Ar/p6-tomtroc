<?php
declare(strict_types = 1);

namespace App\Exception;

use Exception;

class UnauthorizedActionException extends Exception
{
    public function __construct(string $message = "", int $code = 403) {
        parent::__construct($message, $code);
    }
}
