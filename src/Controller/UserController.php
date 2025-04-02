<?php

namespace App\Controller;

use App\Entity\User;
use App\Exception\FileUploadError;
use App\Exception\UserNotFoundException;
use App\Framework\Exception\ViewNotFoundException;
use App\Repository\BookRepository;
use App\Repository\UserRepository;
use App\Service\SessionManager;
use App\Util\FileUploader;

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
     * @throws FileUploadError
     */
    public function showAccount() : void
    {
        $user = new UserRepository()->findOne(SessionManager::get('user')['id']);
        $books = new BookRepository()->findBy(['ownerId', $user['id']], true, 'createdAt DESC');

        if (!$user) {
            throw new UserNotFoundException('Impossible de trouver les informations liées à votre compte utilisateur.');
        }

        if ($this->isSubmit('update-profil-submit')) {
            $data = $this->getRequest()->getParsedBody();
            $update = $this->processUpdateUser($data, $user);

            if ($update) {
                SessionManager::set('user', [
                    'id' => $user['id'],
                    'username' => $data['username'],
                    'email' => $data['email'],
                ]);
                $this->addMessage('success', 'Profil modifié', 'Modification de votre profil effectué avec succès.');
            } else {
                $this->addMessage(
                    'error',
                    'Une erreur est survenue',
                    'Une erreur est survenue lors de la modification de votre profil'
                );
            }

            $this->locate('/account');
            return;
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

    /**
     * Modifie le profil d'un utilisateur
     * @param array $data
     * @param array $user
     * @return bool
     * @throws FileUploadError
     */
    private function processUpdateUser(array $data, array $user) : bool
    {
        unset($data['update-profil-submit']);

        if (!empty(trim($data['password']))) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        } else {
            unset($data['password']);
        }

        if (isset($_FILES['avatar']) && $_FILES["avatar"]["size"] !== 0) {
            $data['avatar'] = FileUploader::upload($_FILES["avatar"], 100);
        } else {
            unset($data['avatar']);
        }

        return new UserRepository()->update($data, ['id', $user['id']]);
    }
}
