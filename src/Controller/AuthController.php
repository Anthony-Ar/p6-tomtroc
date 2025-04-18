<?php

namespace App\Controller;

use App\Entity\User;
use App\Exception\UserNotFoundException;
use App\Framework\Exception\ViewNotFoundException;
use App\Repository\BookRepository;
use App\Repository\UserRepository;
use App\Service\SessionManager;

class AuthController extends MainController
{
    /**
     * Création d'un compte utilisateur
     * @return void
     * @throws ViewNotFoundException
     */
    public function registration() : void
    {
        if ($this->isSubmit('registration-submit')) {
            $data = $this->getRequest()->getParsedBody();

            $user = new User($data);
            $newUser = new UserRepository()->addUser($user);
            $user->id = $newUser;

            SessionManager::login($user);

            $this->locate('/');
            return;
        }

        $this->render('Inscription', 'pages/auth/registration');
    }

    /**
     * Connexion utilisateur
     * @return void
     * @throws ViewNotFoundException
     */
    public function login() : void
    {
        if ($this->isSubmit('login-submit')) {
            $data = $this->getRequest()->getParsedBody();

            $user = new UserRepository()->findOneByEmail(htmlspecialchars($data['email']));

            if (!$user || !password_verify($data['password'], $user->password)) {
                $this->invalidCredentials();
                return;
            }

            SessionManager::login($user);

            $this->locate('/');
            return;
        }

        $this->render('Inscription', 'pages/auth/login');
    }

    /**
     * Déconnexion utilisateur
     * @return void
     */
    public function logout() : void
    {
        SessionManager::remove('user');
        $this->addMessage(
            'success',
            '',
            'Vous êtes déconnecté de l\'application TomTroc.'
        );
        $this->locate('/');
    }

    /**
     * Utilitaire message de connexion invalidCredentials
     * Le système affiche le même message pour un email ou un mot de passe invalide
     * afin de ne pas donner d'informations non nécessaires
     * @return void
     */
    private function invalidCredentials() : void
    {
        $this->addMessage(
            'error',
            'Connexion impossible',
            'Vos identifiants sont invalides.'
        );
        $this->locate('/login');
    }
}
