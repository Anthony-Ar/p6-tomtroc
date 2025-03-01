<?php
declare(strict_types=1);

namespace App\Controller;

use App\Framework\Exception\ViewNotFoundException;
use App\Framework\Http\Interface\RequestInterface;
use App\Framework\View\View;
use App\Util\NoticeMessage;

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

    /**
     * @param RequestInterface $request
     * @return void
     */
    public static function setRequest(RequestInterface $request) : void
    {
        self::$request = $request;
    }

    /**
     * @return RequestInterface
     */
    protected function getRequest() : RequestInterface
    {
        return self::$request;
    }

    /**
     * @param string $submit
     * @return bool
     */
    protected function isSubmit(string $submit) : bool
    {
        return $this->getRequest()->getMethod() === 'POST' && isset($this->getRequest()->getParsedBody()[$submit]);
    }

    /**
     * @param string $type
     * @param string $title
     * @param string $message
     * @return void
     */
    protected function addMessage(string $type, string $title, string $message) : void
    {
        NoticeMessage::add(
            $type,
            $title,
            $message
        );
    }

    protected function locate(string $uri) : void
    {
        header('location: '. $uri);
    }
}
