<?php
/**
 * Définition des routes de l'application.
 * Niveau de sécurité (need_connection) :
 * true / false - Nécessite d'être connecté ou non à l'application.
 */

return [
    // Pages
    'app.home' => [
        'path' => '/',
        'callable' => ['App\Controller\HomeController', 'showHome'],
    ],
    'app.add-book' => [
        'path' => '/add-book',
        'callable' => ['App\Controller\BookController', 'showAddBook'],
    ],
];
