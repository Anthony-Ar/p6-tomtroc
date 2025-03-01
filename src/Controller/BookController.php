<?php

declare(strict_types = 1);

namespace App\Controller;

use App\Entity\Book;
use App\Framework\Exception\ViewNotFoundException;
use App\Repository\BookRepository;

class BookController extends MainController
{
    /**
     * Affiche la page "Nos livres à l'échange"
     * @return void
     * @throws ViewNotFoundException
     */
    public function showBooks() {
        $this->render('Nos livres à l\'échange', 'pages/book/books');
    }

    /**
     * Ajoute un nouveau livre à la base de données
     * @return void
     * @throws ViewNotFoundException
     */
    public function addBook() : void
    {
        if ($this->isSubmit('add-book-submit')) {
            $data = $this->getRequest()->getParsedBody();

            $book = new Book();
            $book->author = $data['author'];
            $book->title = $data['title'];
            $book->description = $data['description'];
            $book->cover = $data['cover'];
            $book->state = boolval($data['state']);
            // Ajouter ownerId en fonction de l'utilisateur connecté.
            $book->ownerId = 0;

            new BookRepository()->addBook($book);
        }

        $this->render(
            'Ajouter un livre à ma bibliothèque',
            'pages/book/add_book',
            [
                'testVar' => 'test'
            ]
        );
    }
}
