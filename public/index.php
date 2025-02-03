<?php

declare(strict_types = 1);

session_start();

use App\Controller\MainController;
use App\Exception\UserAccessDeniedException;
use App\Framework\Exception\HttpException\InvalidStreamFormatException;
use App\Framework\Exception\HttpException\InvalidUriException;
use App\Framework\Exception\HttpException\UnableToOpenResourceException;
use App\Framework\Exception\RouterException\ClassNotFoundException;
use App\Framework\Exception\RouterException\RouteNotFoundException;
use App\Framework\Exception\RouterException\RouterBadRequestException;
use App\Framework\Http\Factory\ServerRequestFactory;
use App\Framework\Router\Router;

class Main
{
    /**
     * Point d'entrée de l'application TomTroc
     * @return void
     * @throws ClassNotFoundException
     * @throws InvalidUriException
     * @throws ReflectionException
     * @throws RouteNotFoundException
     * @throws RouterBadRequestException
     * @throws UserAccessDeniedException
     * @throws InvalidStreamFormatException
     * @throws UnableToOpenResourceException
     */
    public function __invoke() : void
    {
        require_once dirname(__DIR__) . '/config/Autoloader.php';
        Autoloader::register();

        set_exception_handler("App\Framework\ExceptionHandler::handle");

        $request = ServerRequestFactory::createFromGlobal();
        MainController::setRequest($request);

        $router = new Router($request->getUri());
        $router->match();
    }
}

new Main()();
