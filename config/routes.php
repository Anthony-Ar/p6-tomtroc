<?php
/**
 * Définition des routes de l'application.
 * Niveau de sécurité (need_connection) :
 * true / false - Nécessite d'être connecté ou non à l'application.
 */

const AUTH_CONTROLLER = "App\Controller\AuthController";
const USER_CONTROLLER = "App\Controller\UserController";
const BOOK_CONTROLLER = "App\Controller\BookController";
const MESSAGE_CONTROLLER = "App\Controller\MessageController";

return [
    // Routes d'authentification de l'application
    'app.registration' => [
        'path' => '/registration',
        'callable' => [AUTH_CONTROLLER, 'registration'],
    ],
    'app.login' => [
        'path' => '/login',
        'callable' => [AUTH_CONTROLLER, 'login'],
    ],
    'app.logout' => [
        'path' => '/logout',
        'callable' => [AUTH_CONTROLLER, 'logout'],
        'need_connection' => true
    ],

    // Accueil
    'app.home' => [
        'path' => '/',
        'callable' => ['App\Controller\HomeController', 'showHome'],
    ],

    // Livres
    'app.update-book' => [
        'path' => '/book/update/{id}',
        'callable' => [BOOK_CONTROLLER, 'updateBook'],
        'need_connection' => true
    ],
    'app.show-book' => [
        'path' => '/books/{id}',
        'callable' => [BOOK_CONTROLLER, 'showBook'],
    ],
    'app.show-books' => [
        'path' => '/books',
        'callable' => [BOOK_CONTROLLER, 'showBooks'],
    ],
    'app.delete-book' => [
        'path' => '/book/delete/{id}',
        'callable' => [BOOK_CONTROLLER, 'deleteBook'],
        'need_connection' => true
    ],

    // Utilisateurs
    'app.profil' => [
        'path' => '/profil/{id}',
        'callable' => [USER_CONTROLLER, 'showUser'],
    ],
    'app.account' => [
        'path' => '/account',
        'callable' => [USER_CONTROLLER, 'showAccount'],
        'need_connection' => true
    ],

    // Messagerie
    'app.messenger' => [
        'path' => '/messagerie',
        'callable' => [MESSAGE_CONTROLLER, 'showMessenger'],
        'need_connection' => true
    ],
    'app.messages' => [
        'path' => '/messagerie/{id}',
        'callable' => [MESSAGE_CONTROLLER, 'showMessages'],
        'need_connection' => true
    ]
];
