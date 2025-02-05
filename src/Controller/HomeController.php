<?php

declare(strict_types = 1);

namespace App\Controller;

use App\Entity\Book;
use App\Framework\Exception\ViewNotFoundException;
use App\Repository\BookRepository;

class HomeController extends MainController
{
    /**
     * @return void
     * @throws ViewNotFoundException
     */
    public function showHome() : void
    {
        $this->render(
            'Accueil',
            'pages/home/home',
        );
    }
}
