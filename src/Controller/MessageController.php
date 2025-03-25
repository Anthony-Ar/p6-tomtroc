<?php

namespace App\Controller;

use App\Framework\Exception\ViewNotFoundException;

class MessageController extends MainController
{
    /**
     * Affiche l'accueil de la messagerie
     * @return void
     * @throws ViewNotFoundException
     */
    public function showMessenger() : void
    {
        $this->render('Messagerie', 'pages/message/messenger');
    }
}
