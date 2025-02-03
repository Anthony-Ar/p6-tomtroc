<?php
declare(strict_types=1);

namespace App\Framework\Http\Factory;

use App\Framework\Exception\HttpException\InvalidStreamFormatException;
use App\Framework\Exception\HttpException\UnableToOpenResourceException;
use App\Framework\Http\Interface\StreamInterface;
use App\Framework\Http\Stream;
use InvalidArgumentException;

class StreamFactory implements StreamFactoryInterface
{
    private const string PHP_TEMP = "php://temp";

    /**
     * @param string $content
     * @return StreamInterface
     * @throws InvalidStreamFormatException
     * @throws UnableToOpenResourceException
     */
    public function createStream(string $content = ''): StreamInterface
    {
        $resource = @fopen(self::PHP_TEMP, 'r+');

        self::assertResource($resource);

        fwrite($resource, $content);
        rewind($resource);

        return $this->createStreamFromResource($resource);
    }

    /**
     * @param string $filename
     * @param string $mode
     * @return StreamInterface
     * @throws InvalidStreamFormatException
     * @throws UnableToOpenResourceException
     */
    public function createStreamFromFile(string $filename, string $mode = 'r'): StreamInterface
    {
        if ($mode === '' || !preg_match('/^[rwaxce][bt]?[+]?$/', $mode)) {
            throw new InvalidArgumentException(
                sprintf(
                    'Invalid file opening mode "%s"',
                    $mode
                )
            );
        }

        $resource = @fopen($filename, $mode);

        if (!is_resource($resource)) {
            throw new UnableToOpenResourceException(
                sprintf(
                    'Impossible d\'ouvrir le fichier "%s"',
                    $filename
                )
            );
        }

        return new Stream($resource);
    }

    /**
     * @param $resource
     * @return StreamInterface
     * @throws InvalidStreamFormatException
     * @throws UnableToOpenResourceException
     */
    public function createStreamFromResource($resource): StreamInterface
    {
        if (!is_resource($resource)) {
            $resource = @fopen(self::PHP_TEMP, 'r+');
        }

        self::assertResource($resource);

        return new Stream($resource);
    }

    /**
     * @param mixed $resource
     * @return void
     * @throws UnableToOpenResourceException
     */
    protected static function assertResource(mixed $resource) : void
    {
        if (!is_resource($resource)) {
            throw new UnableToOpenResourceException(
                'Impossible d\'accéder à la ressource (php://temp).'
            );
        }
    }
}
