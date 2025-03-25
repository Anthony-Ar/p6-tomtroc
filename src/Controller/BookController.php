<?php

declare(strict_types = 1);

namespace App\Controller;

use App\Exception\BookNotFoundException;
use App\Exception\UnauthorizedActionException;
use App\Framework\Exception\ViewNotFoundException;
use App\Repository\BookRepository;
use App\Service\SessionManager;

class BookController extends MainController
{
    /**
     * Affiche les détails d'un livre
     * @param int $id
     * @return void
     * @throws BookNotFoundException
     * @throws ViewNotFoundException
     */
    public function showBook(int $id) : void
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
     * Modifie un livre de la base de données
     * @param int $id
     * @return void
     * @throws UnauthorizedActionException
     * @throws ViewNotFoundException
     */
    public function updateBook(int $id) : void
    {
        $book = new BookRepository()->findOne($id);

        if (!$book || $book['ownerId'] !== SessionManager::get('user')['id']) {
            throw new UnauthorizedActionException('Impossible de modifier ce livre.');
        }

        if ($this->isSubmit('add-book-submit')) {
            $data = $this->getRequest()->getParsedBody();


        }

        $this->render(
            'Modifier un livre',
            'pages/book/update_book',
            [
                'book' => $book,
            ]
        );
    }

    /**
     * Suppression d'un livre existant
     * @param int $id
     * @return void
     * @throws UnauthorizedActionException
     */
    public function deleteBook(int $id) : void
    {
        $bookRepository = new BookRepository();
        $book = $bookRepository->findOne($id);

        if (!$book || $book['ownerId'] !== SessionManager::get('user')['id']) {
            throw new UnauthorizedActionException('Impossible de supprimer ce livre.');
        }

        $bookRepository->delete($id);

        $this->addMessage(
            'success',
            'Livre supprimé !',
            sprintf('Le livre %s à été supprimé avec succès.', $book['title'])
        );

        $this->locate('/account');
    }
}
