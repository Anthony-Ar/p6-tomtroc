<?php
/**
 * Définition des routes de l'application.
 * Niveau de sécurité (need_connection) :
 * true / false - Nécessite d'être connecté ou non à l'application.
 */

return [
    // Connexion & Inscription
    'app.registration' => [
        'path' => '/registration',
        'callable' => ['App\Controller\UserController', 'registration'],
    ],
    'app.logout' => [
        'path' => '/logout',
        'callable' => ['App\Controller\UserController', 'logout'],
    ],

    // Pages
    'app.home' => [
        'path' => '/',
        'callable' => ['App\Controller\HomeController', 'showHome'],
    ],
    'app.add-book' => [
        'path' => '/add-book',
        'callable' => ['App\Controller\BookController', 'AddBook'],
    ],
    'app.show-books' => [
        'path' => '/books',
        'callable' => ['App\Controller\BookController', 'showBooks'],
    ],
];
