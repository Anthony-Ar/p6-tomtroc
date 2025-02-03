<?php
declare(strict_types=1);

namespace App\Framework\Router;

use App\Framework\Exception\RouterException\ClassNotFoundException;

class RouteCollection
{
    private static array $routes;

    /**
     * @throws ClassNotFoundException
     */
    public static function getRoutes(): array
    {
        if (empty(self::$routes)) {
            self::init();
        }

        return self::$routes;
    }

    /**
     * @throws ClassNotFoundException
     */
    public static function init() : void
    {
        $routes = include_once '../config/routes.php';

        foreach($routes as $name => $route) {
            $protectedAccess = $route['need_connection'] ?? false;

            if (is_array($route['callable'])) {
                $callable = $route['callable'][0];
                $type = 'class';
            } else {
                $callable = $route['callable'];
                $type = 'method';
            }

            if (class_exists($callable)) {
                self::$routes[$name] = new Route($route['path'], $route['callable'], $type, $protectedAccess);
            } else {
                throw new ClassNotFoundException('Impossible de trouver la class correspondante.');
            }
        }
    }
}
