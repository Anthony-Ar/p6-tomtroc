<?php

declare(strict_types = 1);

namespace App\Framework\Router;

use App\Exception\UserAccessDeniedException;
use App\Framework\Exception\RouterException\ClassNotFoundException;
use App\Framework\Exception\RouterException\RouteNotFoundException;
use App\Framework\Exception\RouterException\RouterBadRequestException;
use App\Framework\Http\Uri;
use App\Util\ConnectionChecker;
use ReflectionException;

class Router
{
    private array $routes;

    /**
     * @param Uri $uri
     * @throws ClassNotFoundException
     */
    public function __construct(private readonly Uri $uri)
    {
        $this->routes = RouteCollection::getRoutes();
    }

    /**
     * @return mixed
     * @throws ReflectionException
     * @throws RouteNotFoundException
     * @throws UserAccessDeniedException
     * @throws RouterBadRequestException
     */
    public function match() : mixed
    {
        foreach ($this->routes as $route) {
            if ($this->pathMatch($route->path) !== 0) {
                if ($route->protectedAccess) {
                    ConnectionChecker::assertIsConnected();
                }

                return $this->call($route);
            }
        }

        throw new RouteNotFoundException('Impossible de trouver une route correspondante.');
    }

    /**
     * @param Route $route
     * @return mixed
     * @throws ReflectionException
     * @throws RouterBadRequestException
     */
    private function call(Route $route) : mixed
    {
        $callable = $route->callable;
        $argsValue = $this->getArgsValues($route);

        $callable = [new $callable[0](), $callable[1]];

        return call_user_func_array($callable, $argsValue);
    }

    /**
     * @param string $path
     * @return string
     */
    private function getRoutePattern(string $path) : string
    {
        $pattern = str_replace("/", "\/", $path);
        $pattern = sprintf("/^%s$/", $pattern);
        return preg_replace_callback('/(\{\w+})/', fn() => sprintf('(%s)?', '.+'), $pattern);
    }

    /**
     * @param string $path
     * @return int
     */
    private function pathMatch(string $path) : int
    {
        return preg_match($this->getRoutePattern($path), $this->getParsedPath());
    }

    /**
     * @return string
     */
    private function getParsedPath() : string
    {
        $path = $this->uri->getPath();
        while (str_ends_with($path, '/') && strlen($path) > 1) {
            $path = substr($path, 0, strlen($path) - 1);
        }
        return $path;
    }

    /**
     * @param Route $route
     * @return array
     * @throws ReflectionException
     * @throws RouterBadRequestException
     */
    private function getArgsValues(Route $route) : array
    {
        $values = [];
        $args = $route->resolveArguments();

        if (count($args) > 0) {
            preg_match_all("/{(\w+)}/", $route->path, $paramMatches);

            if (count($paramMatches[1]) > 0) {
                preg_match($this->getRoutePattern($route->path), $this->getParsedPath(), $matches);

                if (count($matches) > 1) {
                    array_shift($matches);
                    foreach ($paramMatches[1] as $i => $parameter) {
                        $values[$parameter] = $matches[$i];
                    }
                } else {
                    throw new RouterBadRequestException(
                        'Un ou plusieurs paramètres sont manquants pour accéder à cette page.'
                    );
                }
            }

            return array_map(
                function (string $name) use ($values) {
                    return $values[$name];
                },
                $args
            );
        }

        return [];
    }
}
