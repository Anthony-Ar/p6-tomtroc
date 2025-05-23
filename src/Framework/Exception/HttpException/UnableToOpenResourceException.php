<?php
declare(strict_types = 1);

namespace App\Framework\Exception\HttpException;

use Exception;

class UnableToOpenResourceException extends Exception
{
    public function __construct(string $message = "", int $code = 0) {
        parent::__construct($message, $code);
    }
}
