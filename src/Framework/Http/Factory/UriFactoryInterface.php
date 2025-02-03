<?php

namespace App\Framework\Http\Factory;

use App\Framework\Http\Uri;

interface UriFactoryInterface
{
/**
* Create a new URI.
*
* @param string $uri The URI to parse.
*
* @throws \InvalidArgumentException If the given URI cannot be parsed.
*/
public function createUri(string $uri = '') : Uri;
}
