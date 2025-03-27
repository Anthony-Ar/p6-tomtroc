<?php

namespace App\Controller;

use App\Framework\Exception\ViewNotFoundException;
use App\Repository\MessageRepository;
use App\Repository\UserRepository;
use App\Service\SessionManager;

class MessageController extends MainController
{
    /**
     * Affiche l'accueil de la messagerie
     * @return void
     * @throws ViewNotFoundException
     */
    public function showMessenger() : void
    {
        $id = 32;
        $messageRepository = new MessageRepository();

        $profil = new UserRepository()->findOne($id);
        $discussions = $messageRepository->fetchDiscussions(SessionManager::get('user')['id']);
        $messages = $messageRepository->fetchMessages(SessionManager::get('user')['id'], $id);

        $this->render(
            'Messagerie',
            'pages/message/messenger',
            [
                'profil' => $profil,
                'discussions' => $discussions,
                'messages' => $messages,
                'id' => $id
            ]
        );
    }

    public function showMessages(int $id) : void
    {
        $this->render('Messagerie', 'pages/message/messages');
    }
}
