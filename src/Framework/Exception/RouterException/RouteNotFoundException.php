<?php
declare(strict_types = 1);

namespace App\Framework\Exception\RouterException;

use Exception;

class RouteNotFoundException extends Exception
{
    public function __construct(string $message = "", int $code = 404) {
        parent::__construct($message, $code);
    }
}
