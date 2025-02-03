<?php

namespace App\Framework;

use App\Framework\Exception\ViewNotFoundException;
use App\Framework\View\View;
use Throwable;

class ExceptionHandler
{
    /**
     * Affiche la page d'erreur en transmettant l'exception interceptée
     * @param Throwable $exception
     * @return void
     * @throws ViewNotFoundException
     */
    public static function handle(Throwable $exception) : void
    {
        $message = $exception->getMessage();
        $code = $exception->getCode();

        // Possible log, trace etc de l'exception...
        switch ($exception->getCode()) {
            case 0: // TypeError
                $message = "Le paramètre fournit par l'URL ne permet pas d'accéder à cette page.";
                $code = 400;
                break;
            default:
                break;
        }

        $view = new View("Erreur " . $code);
        $view->render("error", [
            'codeError' => $code,
            'messageError' => $message
        ]);
    }
}
