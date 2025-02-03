<?php
declare(strict_types = 1);

namespace App\Framework\Exception\RouterException;

use Exception;

class RouterBadRequestException extends Exception
{
    public function __construct(string $message = "", int $code = 400) {
        parent::__construct($message, $code);
    }
}
