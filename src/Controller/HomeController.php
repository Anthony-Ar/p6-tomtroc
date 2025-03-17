<?php

declare(strict_types = 1);

namespace App\Controller;

use App\Framework\Exception\ViewNotFoundException;
use App\Repository\BookRepository;

class HomeController extends MainController
{
    /**
     * Affiche la page d'accueil
     * @return void
     * @throws ViewNotFoundException
     */
    public function showHome() : void
    {
        $books = new BookRepository()->findAll('createdAt DESC', 4);

        $this->render(
            'Accueil',
            'pages/home/home',
            ['books' => $books]
        );
    }
}
