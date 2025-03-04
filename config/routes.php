<?php
/**
 * Définition des routes de l'application.
 * Niveau de sécurité (need_connection) :
 * true / false - Nécessite d'être connecté ou non à l'application.
 */

const USER_CONTROLLER = "App\Controller\UserController";
const BOOK_CONTROLLER = "App\Controller\BookController";

return [
    // Connexion & Inscription
    'app.registration' => [
        'path' => '/registration',
        'callable' => [USER_CONTROLLER, 'registration'],
    ],
    'app.login' => [
        'path' => '/login',
        'callable' => [USER_CONTROLLER, 'login'],
    ],
    'app.logout' => [
        'path' => '/logout',
        'callable' => [USER_CONTROLLER, 'logout'],
        'need_connection' => true
    ],

    // Pages
    'app.home' => [
        'path' => '/',
        'callable' => ['App\Controller\HomeController', 'showHome'],
    ],
    'app.add-book' => [
        'path' => '/add-book',
        'callable' => [BOOK_CONTROLLER, 'addBook'],
        'need_connection' => true
    ],
    'app.show-books' => [
        'path' => '/books',
        'callable' => [BOOK_CONTROLLER, 'showBooks'],
    ],
    'app.profil' => [
        'path' => '/profil/{id}',
        'callable' => [USER_CONTROLLER, 'showUser'],
    ]
];
