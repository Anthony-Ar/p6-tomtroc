<?php
/**
 * Définition des routes de l'application.
 * Niveau de sécurité (need_connection) :
 * true / false - Nécessite d'être connecté ou non à l'application.
 */

return [
    // Erreurs
//    'app.error.404' => [
//        'path' => '/404',
//        'controller' => ['', '']
//    ],

    // Pages
    'app.add-books' => [
        'path' => '/{id}',
        'callable' => ['App\Controller\HomeController', 'index'],
    ],
    'app.add-books2' => [
        'path' => '/test',
        'callable' => ['App\Controller\HomeController', 'index'],
        'need_connection' => true,
    ],
];
