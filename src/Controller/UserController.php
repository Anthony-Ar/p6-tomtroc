<?php

namespace App\Controller;

use App\Entity\User;
use App\Exception\UserNotFoundException;
use App\Framework\Exception\ViewNotFoundException;
use App\Repository\BookRepository;
use App\Repository\UserRepository;
use App\Service\SessionManager;

class UserController extends MainController
{
    /**
     * Affiche le profil d'un utilisateur
     * @param int $id
     * @return void
     * @throws UserNotFoundException
     * @throws ViewNotFoundException
     */
    public function showUser(int $id) : void
    {
        $user = new UserRepository()->findOne($id);

        if (!$user) {
            throw new UserNotFoundException('Impossible de trouver l\'utilisateur recherché');
        }

        $books = new BookRepository()->findBy(['ownerId', $id], true, 'createdAt DESC');

        $this->render(
            sprintf('Profil de %s', $user['username']),
            'pages/user/profil',
            [
                'user' => $user,
                'books' => $books,
            ]
        );
    }

    /**
     * Affichage du profil privé de l'utilisateur
     * @return void
     * @throws UserNotFoundException
     * @throws ViewNotFoundException
     */
    public function showAccount() : void
    {
        $user = new UserRepository()->findOne(SessionManager::get('user')['id']);
        $books = new BookRepository()->findBy(['ownerId', $user['id']], true, 'createdAt DESC');

        if (!$user) {
            throw new UserNotFoundException('Impossible de trouver les informations liées à votre compte utilisateur.');
        }

        $this->render(
            'Mon compte',
            'pages/user/account',
            [
                'user' => $user,
                'books' => $books,
            ]
        );
    }
}
