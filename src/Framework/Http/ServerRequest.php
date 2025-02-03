<?php
declare(strict_types=1);

namespace App\Framework\Http;

use App\Framework\Exception\HttpException\InvalidUriException;
use App\Framework\Http\Interface\ServerRequestInterface;

class ServerRequest extends Request implements ServerRequestInterface
{
    protected array $serversParams;
    protected array $cookiesParams;
    protected array $queryParams;
    protected array $uploadedFiles;
    protected array|object|null $parsedBody = null;
    protected array $attributes;

    /**
     * @param string $method
     * @param $uri
     * @param $body
     * @param array $headers
     * @param string $version
     * @param array $serverParams
     * @param array $cookieParams
     * @param array $postParams
     * @param array $getParams
     * @param array $filesParams
     * @throws InvalidUriException
     */
    public function __construct(
        string $method = 'GET',
        $uri = '',
        $body = '',
        array $headers = [],
        string $version = '1.1',
        array $serverParams = [],
        array $cookieParams = [],
        array $postParams = [],
        array $getParams = [],
        array $filesParams = []
    ) {
        parent::__construct($method, $uri, $headers, $body, $version);

        $this->serversParams = $serverParams;
        $this->cookiesParams = $cookieParams;
        $this->queryParams  = $getParams;
        $this->attributes   = [];

        $this->determineParsedBody($postParams);

        $this->uploadedFiles = $filesParams;
    }

    /**
     * @return array
     */
    public function getServerParams() : array
    {
        return $this->serversParams;
    }

    /**
     * @return array
     */
    public function getCookieParams() : array
    {
        return $this->cookiesParams;
    }

    /**
     * @param array $cookies
     * @return ServerRequestInterface
     */
    public function withCookieParams(array $cookies) : ServerRequestInterface
    {
        $instance = clone $this;
        $instance->cookiesParams = $cookies;
        return $instance;
    }

    /**
     * @return array
     */
    public function getQueryParams() : array
    {
        return $this->queryParams;
    }

    /**
     * @param array $query
     * @return ServerRequestInterface
     */
    public function withQueryParams(array $query) : ServerRequestInterface
    {
        $instance = clone $this;
        $instance->queryParams = $query;
        return $instance;
    }

    /**
     * @return array
     */
    public function getUploadedFiles() : array
    {
        return $this->uploadedFiles;
    }

    /**
     * @param array $uploadedFiles
     * @return ServerRequestInterface
     */
    public function withUploadedFiles(array $uploadedFiles) : ServerRequestInterface
    {
        $instance = clone $this;
        $instance->uploadedFiles = $uploadedFiles;
        return $instance;
    }

    /**
     * @return array|object|null
     */
    public function getParsedBody() : object|array|null
    {
        return $this->parsedBody;
    }

    /**
     * @param $data
     * @return ServerRequestInterface
     */
    public function withParsedBody($data) : ServerRequestInterface
    {
        $instance = clone $this;
        $instance->parsedBody = $data;
        return $instance;
    }

    /**
     * @return array
     */
    public function getAttributes() : array
    {
        return $this->attributes;
    }

    /**
     * @param string $name
     * @param $default
     * @return mixed|null
     */
    public function getAttribute(string $name, $default = null) : mixed
    {
        return $this->attributes[$name] ?? $default;
    }

    /**
     * @param string $name
     * @param $value
     * @return ServerRequestInterface
     */
    public function withAttribute(string $name, $value) : ServerRequestInterface
    {
        $instance = clone $this;
        $instance->attributes[$name] = $value;
        return $instance;
    }

    /**
     * @param string $name
     * @return ServerRequestInterface
     */
    public function withoutAttribute(string $name) : ServerRequestInterface
    {
        $instance = clone $this;
        unset($instance->attributes[$name]);
        return $instance;
    }

    /**
     * @param array $postParams
     * @return void
     */
    protected function determineParsedBody(array $postParams) : void
    {
        $headerContentType = $this->getHeaderLine('Content-Type');
        $contentTypeArr = preg_split('/\s*[;,]\s*/', $headerContentType);
        $contentType = strtolower($contentTypeArr[0]);
        $httpMethod = strtoupper($this->getMethod());

        $isForm = false;

        if ($httpMethod === 'POST') {
            $postRequiredContentTypes = [
                'application/x-www-form-urlencoded',
                'multipart/form-data',
            ];

            if (in_array($contentType, $postRequiredContentTypes)) {
                $this->parsedBody = $postParams ?? null;
                $isForm = true;
            }
        }

        if ($httpMethod !== 'GET' && !$isForm) {
            $isJson = false;
            $rawText = file_get_contents('php://input');

            if (!empty($rawText)) {
                if ($contentType === 'application/json') {
                    $jsonParsedBody = json_decode($rawText);
                    $isJson = (json_last_error() === JSON_ERROR_NONE);
                }

                if ($isJson) {
                    $this->parsedBody = $jsonParsedBody ?: null;
                }

                if (!$isJson) {
                    parse_str($rawText, $parsedStr);
                    $this->parsedBody = $parsedStr ?: null;
                }
            }
        }
    }
}
