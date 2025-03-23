<?php

declare(strict_types = 1);

namespace App\Controller;

use App\Entity\Book;
use App\Exception\BookNotFoundException;
use App\Exception\UnauthorizedActionException;
use App\Framework\Exception\ViewNotFoundException;
use App\Repository\BookRepository;
use App\Service\SessionManager;

class BookController extends MainController
{
    /**
     * Affiche les détails d'un livre
     * @return void
     * @throws ViewNotFoundException
     * @throws BookNotFoundException
     */
    public function showBook(int $id)
    {
        $book = new BookRepository()->findOne($id);

        if (!$book) {
            throw new BookNotFoundException('Impossible de trouver le livre correspondant.');
        }

        $this->render($book['title'], 'pages/book/book', ['book' => $book]);
    }

    /**
     * Affiche la page "Nos livres à l'échange",
     * qui contient tous les livres disponibles à l'échange
     * @return void
     * @throws ViewNotFoundException
     */
    public function showBooks() : void
    {
        $books = new BookRepository();

        if ($this->isSubmit('search')) {
            $data = $this->getRequest()->getParsedBody();
            $books = $books->findBy(['title', $data['search']], false);
        } else {
            $books = $books->findAll('createdAt ASC');
        }

        $this->render('Nos livres à l\'échange', 'pages/book/books', ['books' => $books]);
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

    /**
     * Suppression d'un livre existant
     * @param int $id
     * @return void
     * @throws BookNotFoundException
     * @throws UnauthorizedActionException
     */
    public function deleteBook(int $id) : void
    {
        $bookRepository = new BookRepository();
        $book = $bookRepository->findOne($id);

        if (!$book) {
            throw new BookNotFoundException('Impossible de trouver le livre correspondant.');
        }

        if ($book['ownerId'] !== SessionManager::get('user')['id']) {
            throw new UnauthorizedActionException('Impossible de supprimer ce livre.');
        }

        $name = $book['title'];

        $bookRepository->delete($id);

        $this->addMessage(
            'success',
            'Livre supprimé !',
            sprintf('Le livre %s à été supprimé avec succès.', $name)
        );

        $this->locate('/account');
    }
}
