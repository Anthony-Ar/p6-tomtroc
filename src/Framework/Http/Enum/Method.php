<?php

namespace App\Framework\Http\Enum;

enum Method: string
{
    case GET = 'GET';
    case POST = 'POST';
    case PUT = 'PUT';
    case PATCH = 'PATCH';
    case DELETE = 'DELETE';
    case CONNECT = 'CONNECT';
    case HEAD = 'HEAD';
    case OPTIONS = 'OPTIONS';
}
