<?php

declare(strict_types = 1);

namespace App\Framework\Router;

use ReflectionClass;
use ReflectionException;
use ReflectionFunction;
use ReflectionParameter;

class Route
{
    public string $path {
        get {
            return $this->path;
        }
    }
    public mixed $callable {
        get {
            return $this->callable;
        }
    }
    public string $callableType {
        get {
            return $this->callableType;
        }
    }

    public bool $protectedAccess;

    public function __construct(string $path, $callable, string $callableType, bool $protectedAccess)
    {
        $this->path = $path;
        $this->callable = $callable;
        $this->callableType = $callableType;
        $this->protectedAccess = $protectedAccess;
    }

    /**
     * @return array
     * @throws ReflectionException
     */
    public function resolveArguments() : array
    {
        if ($this->callableType === 'class') {
            $params = new ReflectionClass($this->callable[0])->getMethod($this->callable[1])->getParameters();
        } else {
            $params = new ReflectionFunction($this->callable)->getParameters();
        }
        return array_map(fn(ReflectionParameter $param) => $param->getName(), $params);
    }


}
