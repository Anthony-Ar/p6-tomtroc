<?php

declare(strict_types=1);

namespace App\Framework\Http;

use App\Framework\Http\Interface\ResponseInterface;
use App\Framework\Http\Interface\StreamInterface;

class Response extends Message implements ResponseInterface
{
    /**
     * @param int $status
     * @param array $headers
     * @param string|StreamInterface $body
     * @param string $version
     * @param string $reasonPhrase
     */
    public function __construct(
        protected int $status = 200,
        array $headers = [],
        string|StreamInterface $body = '',
        string $version = '1.1',
        protected string $reasonPhrase = 'OK'
    ) {
        $this->setHeaders($headers);
        $this->body = $body;
        $this->version = $version;
    }

    /**
     * @return int
     */
    public function getStatusCode() : int
    {
        return $this->status;
    }

    /**
     * @param int $code
     * @param string $reasonPhrase
     * @return ResponseInterface
     */
    public function withStatus(int $code, string $reasonPhrase = '') : ResponseInterface
    {
        if ($reasonPhrase === '' ) {
            $reasonPhrase = $code;
        }

        $instance = clone $this;
        $instance->status = $code;
        $instance->reasonPhrase = $reasonPhrase;

        return $instance;
    }

    /**
     * @return string
     */
    public function getReasonPhrase() : string
    {
        return $this->reasonPhrase;
    }
}
