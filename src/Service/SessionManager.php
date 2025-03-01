<?php

namespace App\Service;

use App\Entity\User;
use App\Util\NoticeMessage;

class SessionManager
{
    /**
     * Créer une nouvelle variable de session
     * @param $key
     * @param $value
     * @return void
     */
    public static function set($key, $value) : void
    {
        session_regenerate_id(true);
        $_SESSION[$key] = $value;
    }

    /**
     * Récupère une variable de session
     * @param $key
     * @return mixed
     */
    public static function get($key) : mixed
    {
        return $_SESSION[$key] ?? null;
    }

    /**
     * Vérifie si une variable de session existe
     * @param $key
     * @return bool
     */
    public static function has($key) : bool
    {
        return isset($_SESSION[$key]);
    }

    /**
     * Supprime une variable de session
     * @param $key
     * @return void
     */
    public static function remove($key) : void
    {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }

    /**
     * Supprime toutes les données stockées dans $_SESSION
     * @return void
     */
    public static function destroy() : void
    {
        session_unset();
        session_destroy();
    }

    /**
     * Connexion utilisateur
     * @param User $user
     * @return void
     */
    public static function login(User $user) : void
    {
        self::set('user', [
            'id' => $user->id,
            'username' => $user->username,
            'email' => $user->email,
        ]);

        NoticeMessage::add(
            'success',
            '',
            'Vous êtes désormais connecté sur l\'application TomTroc.'
        );
    }
}
