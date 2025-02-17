<?php

namespace App\Util;

use App\Entity\User;

class SessionManager
{
    /**
     * Connexion utilisateur
     * @param User $user
     * @return void
     */
    public static function login(User $user) : void
    {
        session_regenerate_id(true);
        $_SESSION['user'] = [
            'id' => $user->id,
            'username' => $user->username,
            'email' => $user->email,
        ];
    }

    /**
     * Déconnexion utilisateur
     * @return void
     */
    public static function logout() : void
    {
        session_unset();
        session_destroy();
    }
}
