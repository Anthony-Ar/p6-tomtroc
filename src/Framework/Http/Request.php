<?php
declare(strict_types=1);

namespace App\Framework\Http;

use App\Framework\Exception\HttpException\InvalidUriException;
use App\Framework\Http\Enum\Method;
use App\Framework\Http\Factory\UriFactory;
use App\Framework\Http\Interface\RequestInterface;
use App\Framework\Http\Interface\StreamInterface;
use App\Framework\Http\Interface\UriInterface;

class Request extends Message implements RequestInterface
{
    protected ?string $requestTarget = null;

    /**
     * @param string|Method $method
     * @param string|UriInterface $uri
     * @param array $headers
     * @param string|StreamInterface|null $body
     * @param string $httpVersion
     * @throws InvalidUriException
     */
    public function __construct(
        protected string|Method $method,
        protected string|UriInterface $uri,
        array $headers = [],
        string|StreamInterface|null $body = null,
        string $httpVersion = "1.1"
    ) {
        $this->method = is_string($method) ? Method::from(strtoupper($method)) : $method;
        $this->uri = $uri instanceof UriInterface ? $uri : UriFactory::createFromString($uri);
        $this->body = $body instanceof StreamInterface ? $body : "";

        $this->setHeaders($headers);
        $this->version = $httpVersion;
    }

    /**
     * @return string
     */
    public function getRequestTarget() : string
    {
       if (!empty($this->requestTarget)) {
            return $this->requestTarget;
       }

       $target = $this->uri->getPath();

       if (empty($target)) {
           $target = '/';
       }

       if (!empty($this->uri->getQuery())) {
           $target .= '?' . $this->uri->getQuery();
       }

       return $target;
    }

    /**
     * @param string $requestTarget
     * @return RequestInterface
     */
    public function withRequestTarget(string $requestTarget) : RequestInterface
    {
        $instance = clone $this;
        $instance->requestTarget = $requestTarget;
        return $instance;
    }

    /**
     * @return string
     */
    public function getMethod() : string
    {
        return $this->method->value;
    }

    /**
     * @param string $method
     * @return RequestInterface
     */
    public function withMethod(string $method) : RequestInterface
    {
        $instance = clone $this;
        $instance->method = Method::from(strtoupper($method));
        return $instance;
    }

    /**
     * @return UriInterface
     */
    public function getUri() : UriInterface
    {
        return $this->uri;
    }

    /**
     * @param UriInterface $uri
     * @param bool $preserveHost
     * @return RequestInterface
     */
    public function withUri(UriInterface $uri, bool $preserveHost = false) : RequestInterface
    {
        $instance = clone $this;
        $instance->uri = $uri;
        return $instance;
    }
}
