<?php
declare(strict_types=1);

namespace App\Controller;

use App\Framework\Exception\ViewNotFoundException;
use App\Framework\Http\Interface\RequestInterface;
use App\Framework\View\View;

abstract class MainController
{
    private static RequestInterface $request;

    /**
     * @param string $name
     * @param string $path
     * @param array $parameters
     * @return void
     * @throws ViewNotFoundException
     */
    protected function render(string $name, string $path, array $parameters = []) : void
    {
        $view = new View($name);
        $view->render($path, $parameters);
    }

    public static function setRequest(RequestInterface $request) : void
    {
        self::$request = $request;
    }

    protected function getRequest() : RequestInterface
    {
        return self::$request;
    }

    protected function isSubmit() : bool
    {
        return $this->getRequest()->getMethod() === 'POST';
    }
}
