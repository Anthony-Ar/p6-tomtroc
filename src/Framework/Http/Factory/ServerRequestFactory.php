<?php
declare(strict_types=1);

namespace App\Framework\Http\Factory;

use App\Framework\Exception\HttpException\InvalidStreamFormatException;
use App\Framework\Exception\HttpException\InvalidUriException;
use App\Framework\Exception\HttpException\UnableToOpenResourceException;
use App\Framework\Http\Interface\ServerRequestInterface;
use App\Framework\Http\Interface\UriInterface;
use App\Framework\Http\ServerRequest;
use App\Framework\Util\FromGlobal;

class ServerRequestFactory implements ServerRequestFactoryInterface
{
    /**
     * @param string $method
     * @param $uri
     * @param array $serverParams
     * @return ServerRequestInterface
     * @throws InvalidStreamFormatException
     * @throws InvalidUriException
     * @throws UnableToOpenResourceException
     */
    public function createServerRequest(string $method, $uri, array $serverParams = []): ServerRequestInterface
    {
        extract(FromGlobal::extract());

        if ($serverParams !== []) {
            $server = $serverParams;
        }

        $protocol = $server['SERVER_PROTOCOL'] ?? '1.1';
        $protocol = str_replace('HTTP/', '',  $protocol);

        if (!($uri instanceof UriInterface)) {
            $uri = UriFactory::createFromString($uri);
        }

        $streamFactory = new StreamFactory();
        $body = $streamFactory->createStream();

        return new ServerRequest(
            $method,
            $uri,
            $body,
            $header,
            $protocol,
            $server,
            $cookie,
            $post,
            $get,
            $files
        );
    }

    /**
     * @return ServerRequestInterface
     * @throws InvalidStreamFormatException
     * @throws InvalidUriException
     * @throws UnableToOpenResourceException
     */
    public static function createFromGlobal(): ServerRequestInterface
    {
        extract(FromGlobal::extract());

        $method = $server['REQUEST_METHOD'] ?? 'GET';

        $protocol = $server['SERVER_PROTOCOL'] ?? '1.1';
        $protocol = str_replace('HTTP/', '',  $protocol);

        $uri = UriFactory::CreateFromString($server['REQUEST_URI']);

        $streamFactory = new StreamFactory();
        $body = $streamFactory->createStream();

        return new ServerRequest(
            $method,
            $uri,
            $body,
            $header,
            $protocol,
            $server,
            $cookie,
            $post,
            $get,
            $files
        );
    }
}
