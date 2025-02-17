<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Util\NoticeMessage;
use App\Util\SessionManager;

class UserController extends MainController
{
    public function registration() {
        if($this->isSubmit()) {
            $data = $this->getRequest()->getParsedBody();

            $user = new User();
            $user->username = $data['username'];
            $user->email = $data['email'];
            $user->password = $data['password'];

            $newUser = new UserRepository()->addUser($user);
            $user->id = $newUser;

            SessionManager::login($user);
            NoticeMessage::add(
                'success',
                'Vous êtes désormais enregistré et connecté sur l\'application TomTroc.'
            );

            header('location: /');
            return;
        }

        $this->render('Inscription', 'pages/user/registration');
    }

    public function logout() {
        SessionManager::logout();
    }
}
