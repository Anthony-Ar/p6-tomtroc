<?php
declare(strict_types=1);

namespace App\Service;

use App\Exception\UserAccessDeniedException;

class ConnectionChecker {

    /**
     * Assure que l'utilisateur est connecté
     * @return void
     * @throws UserAccessDeniedException
     */
    public static function assertIsConnected(): void {
        if(!SessionManager::has('user')) {
            throw new UserAccessDeniedException('Impossible d\'accéder à ce contenu sans être connecté.');
        }
    }

    /**
     * Retourne le statut de connexion de l'utilisateur
     * @return bool
     */
    public static function isConnected(): bool {
        return SessionManager::has('user');
    }
}
