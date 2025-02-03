<?php
declare(strict_types=1);

namespace App\Framework\Http;

use App\Framework\Http\Interface\UriInterface;

class Uri implements UriInterface
{
    private array $standardPorts = [
        'http' => 80,
        'https' => 443,
    ];

    public function __construct(
        private ?string $scheme = null,
        private ?string $host = null,
        private ?int $port = null,
        private ?string $path = null,
        private ?string $fragment = null,
        private ?string $query = null,
        private ?string $username = null,
        private ?string $password = null
    ) {}

    public function getStandardPorts(string $scheme): ?int
    {
        return $this->standardPorts[$scheme] ?? null;
    }

    public function getScheme() : string
    {
        return $this->scheme ? strtolower($this->scheme) : "";
    }

    public function getAuthority() : string
    {
        if(empty($this->host)) {
            return "";
        }

        $authority = "";

        if($this->getUserInfo()) {
            $authority .= $this->getUserInfo() . "@";
        }

        $authority .= $this->host;

        if($this->getPort()) {
            $authority .= ":" . $this->getPort();
        }
        return $authority;
    }

    public function getUserInfo() : string
    {
        $userInfo = "";

        if ($this->username) {
            $userInfo .= $this->username;
        }

        if ($this->password) {
            $userInfo .= ":" . $this->password;
        }

        return $userInfo;
    }

    public function getHost() : string
    {
        return $this->host ? strtolower($this->host) : "";
    }

    public function getPort() : ?int
    {
        if ($this->port) {
            if ($this->scheme && $this->port !== $this->getStandardPorts($this->scheme)) {
                return null;
            }

            return (int)$this->port;
        }

        return null;
    }

    public function getPath() : string
    {
        return $this->path ?? "";
    }

    public function getQuery() : string
    {
        return $this->query ?? "";
    }

    public function getFragment() : string
    {
        return $this->fragment ?? "";
    }

    public function withScheme($scheme) : static
    {
        $instance = clone $this;
        $instance->scheme = strtolower($scheme);
        return $instance;
    }

    public function withUserInfo($user, $password = null) : static
    {
        $instance = clone $this;
        $instance->username = $user;
        $instance->password = $password ?? "";
        return $instance;
    }

    public function withHost($host) : static
    {
        $instance = clone $this;
        $instance->host = $host;
        return $instance;
    }

    public function withPort($port) : static
    {
        $instance = clone $this;
        $instance->port = $port;
        return $instance;
    }

    public function withPath($path) : static
    {
        $instance = clone $this;
        $instance->path = $path;
        return $instance;
    }

    public function withQuery($query) : static
    {
        $instance = clone $this;
        $instance->query = $query;
        return $instance;
    }

    public function withFragment($fragment) : static
    {
        $instance = clone $this;
        $instance->fragment = $fragment;
        return $instance;
    }

    public function __toString()
    {
        $url = "";

        if ($this->scheme){
            $url .= $this->scheme . ":";
        }

        if($this->getAuthority()){
            $url .= "//" . $this->getAuthority();
        }

        if (empty($this->path) && $this->getAuthority()){
            $url .= "/";
        }
        elseif ($this->path) {
            $url .= "/" . trim($this->path, "/");
        }

        if ($this->query){
            $url .= "?" . $this->query;
        }

        if ($this->fragment){
            $url .= "#" . $this->fragment;
        }

        return $url;
    }
}
