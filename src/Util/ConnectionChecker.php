<?php
declare(strict_types=1);

namespace App\Util;

use App\Exception\UserAccessDeniedException;

class ConnectionChecker {

    /**
     * @return void
     * @throws UserAccessDeniedException
     */
    public static function assertIsConnected(): void {
        if(!isset($_SESSION['user'])) {
            throw new UserAccessDeniedException('Impossible d\'accéder à ce contenu sans être connecté.');
        }
    }
}
