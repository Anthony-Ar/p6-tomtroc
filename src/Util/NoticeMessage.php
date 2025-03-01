<?php

namespace App\Util;

class NoticeMessage
{
    /**
     * Ajoute un message (alerts) à la file d'attente
     * @param string $type
     * @param string $title
     * @param string $message
     * @return void
     */
    public static function add(string $type, string $title, string $message): void {
        if (!isset($_SESSION['messages'])) {
            $_SESSION['messages'] = [];
        }
        $_SESSION['messages'][] = ['type' => $type, 'title' => $title, 'message' => $message];
    }

    /**
     * Récupère la liste des messages en attente puis clean la variable de session
     * @return array
     */
    public static function get(): array {
        $messages = $_SESSION['messages'] ?? [];
        unset($_SESSION['messages']);
        return $messages;
    }
}
