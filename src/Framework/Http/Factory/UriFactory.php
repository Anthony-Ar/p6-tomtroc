<?php
declare(strict_types=1);

namespace App\Framework\Http\Factory;

use App\Framework\Exception\HttpException\InvalidUriException;
use App\Framework\Http\Uri;

class UriFactory implements UriFactoryInterface
{
    /**
     * @param string $uri
     * @return Uri
     * @throws InvalidUriException
     */
    public function createUri(string $uri = ""): Uri
    {
        return self::createFromString($uri);
    }

    /**
     * @param string $uri
     * @return Uri
     * @throws InvalidUriException
     */
    public static function createFromString(string $uri): Uri
    {
        $uriPart = parse_url($uri);

        if ($uriPart === false) {
            throw new InvalidUriException("URL Invalide.");
        }

        return new Uri(
            !empty($uriPart["scheme"]) ? strtolower($uriPart["scheme"]) : null,
            !empty($uriPart["host"]) ? strtolower($uriPart["host"]) : null,
            !empty($uriPart["port"]) ? $uriPart["port"] : null,
            $uriPart["path"] ?? null,
            $uriPart["fragment"] ?? null,
            $uriPart["query"] ?? null,
            $uriPart["user"] ?? null,
            $uriPart["pass"] ?? null,
        );
    }
}
