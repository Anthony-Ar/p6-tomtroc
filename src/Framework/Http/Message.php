<?php
declare(strict_types=1);

namespace App\Framework\Http;

use App\Framework\Exception\HttpException\InvalidProtocolVersionException;
use App\Framework\Http\Interface\MessageInterface;
use App\Framework\Http\Interface\StreamInterface;

class Message implements MessageInterface
{

    protected string $version = "1.1";

    protected array $httpVersions = [
        "1.0", "1.1", "2", "2.0", "3", "3.0"
    ];

    protected array $headers = [];
    protected StreamInterface $body;

    /**
     * @return string
     */
    public function getProtocolVersion() : string
    {
        return $this->version;
    }

    /**
     * @param string $version
     * @return MessageInterface
     * @throws InvalidProtocolVersionException
     */
    public function withProtocolVersion(string $version) : MessageInterface
    {
        if (!in_array($version, $this->httpVersions)) {
            throw new InvalidProtocolVersionException("Version de protocole php non valide.");
        }

        $instance = clone $this;
        $instance->version = $version;
        return $instance;
    }

    /**
     * @return array
     */
    public function getHeaders() : array
    {
        return $this->headers;
    }

    /**
     * @param string $name
     * @return string|null
     */
    public function resolveHeaderKey(string $name) : ?string
    {
        return array_find(
            array_keys($this->headers),
            fn($key) => strtolower($key) === strtolower($name)
        );
    }

    /**
     * @param string $name
     * @return bool
     */
    public function hasHeader(string $name) : bool
    {
        return $this->resolveHeaderKey($name) !== null;
    }

    /**
     * @param string $name
     * @return array
     */
    public function getHeader(string $name) : array
    {
        $key = $this->resolveHeaderKey($name);

        return $this->headers[$key] ?? [];
    }

    /**
     * @param string $name
     * @return string
     */
    public function getHeaderLine(string $name) : string
    {
        $header = $this->getHeader($name);

        return empty($header) ? "" : implode(',', $header);
    }

    /**
     * @param string $name
     * @param $value
     * @return MessageInterface
     */
    public function withHeader(string $name, $value) : MessageInterface
    {
        $instance = clone $this;

        $key = $this->resolveHeaderKey($name);

        if ($key === null) {
            $key = $name;
        }

        if (!is_array($value)) {
            $value = [$value];
        }

        $instance->headers[$key] = $value;
        return $instance;
    }

    /**
     * @param string $name
     * @param $value
     * @return MessageInterface
     */
    public function withAddedHeader(string $name, $value) : MessageInterface
    {
        $key = $this->resolveHeaderKey($name);

        if ($key === null) {
            $key = $name;
        }

        $instance = clone $this;

        if (!is_array($value)) {
            $value = [$value];
        }

        $instance->headers[$key] = array_merge(
            $instance->headers[$key] ?? [],
            $value
        );

        return $instance;
    }

    /**
     * @param string $name
     * @return MessageInterface
     */
    public function withoutHeader(string $name) : MessageInterface
    {
        $key = $this->resolveHeaderKey($name);

        if ($key === null) {
            return $this;
        }

        $instance = clone $this;
        unset($instance->headers[$key]);
        return $instance;
    }

    /**
     * @return StreamInterface
     */
    public function getBody() : StreamInterface
    {
        return $this->body;
    }

    /**
     * @param StreamInterface $body
     * @return MessageInterface
     */
    public function withBody(StreamInterface $body) : MessageInterface
    {
        $instance = clone $this;
        $instance->body = $body;
        return $instance;
    }

    /**
     * @param array $headers
     * @return void
     */
    public function setHeaders(array $headers): void
    {
        foreach ($headers as $name => $value) {
            if (!is_array($value)) {
                $value = [$value];
            }

            $this->headers[$name] = $value;
        }
    }
}
