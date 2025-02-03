<?php
declare(strict_types = 1);

namespace App\Exception;

use Exception;

class UserAccessDeniedException extends Exception
{
    public function __construct(string $message = "", int $code = 401) {
        parent::__construct($message, $code);
    }
}
