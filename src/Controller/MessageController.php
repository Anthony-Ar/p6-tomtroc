<?php

namespace App\Controller;

use App\Entity\Message;
use App\Exception\UserNotFoundException;
use App\Framework\Exception\ViewNotFoundException;
use App\Repository\MessageRepository;
use App\Repository\UserRepository;
use App\Service\SessionManager;
use DateTime;

class MessageController extends MainController
{
    /**
     * Affiche l'accueil de la messagerie
     * @param int $id
     * @return void
     * @throws ViewNotFoundException
     * @throws UserNotFoundException
     */
    public function showMessages(int $id) : void
    {
        $messageRepository = new MessageRepository();

        $profil = new UserRepository()->findOne($id);

        if(!$profil) {
            throw new UserNotFoundException('Impossible de trouver cet utilisateur.');
        }

        $messages = $messageRepository->fetchMessages(SessionManager::get('user')['id'], $id);
        $discussions = $messageRepository->fetchDiscussions(SessionManager::get('user')['id']);

        if ($this->isSubmit('send-message')) {
            $data = $this->getRequest()->getParsedBody();

            $message = [
                'ownerId' => SessionManager::get('user')['id'],
                'receiverId' => $id,
                'content' => htmlspecialchars($data['content']),
            ];

            new MessageRepository()->send(new Message($message));
            $this->locate('/messagerie');
            return;
        }

        $this->render(
            'Messagerie',
            'pages/message/messages',
            [
                'profil' => $profil,
                'discussions' => $discussions,
                'messages' => $messages,
                'id' => $id
            ]
        );
    }

    /**
     * Affiche la liste des conversations de l'utilisateur
     * @return void
     * @throws ViewNotFoundException
     */
    public function showMessenger() : void
    {
        $discussions = new MessageRepository()->fetchDiscussions(SessionManager::get('user')['id']);

        $this->render(
            'Messagerie',
            'pages/message/messenger',
            [
                'discussions' => $discussions,
            ]
        );
    }
}
