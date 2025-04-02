<?php

declare(strict_types = 1);

namespace App\Controller;

use App\Exception\BookNotFoundException;
use App\Exception\FileUploadError;
use App\Exception\UnauthorizedActionException;
use App\Framework\Exception\ViewNotFoundException;
use App\Repository\BookRepository;
use App\Service\SessionManager;
use App\Util\FileUploader;

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
     * @throws FileUploadError
     */
    public function updateBook(int $id) : void
    {
        $book = new BookRepository()->findOne($id);

        if (!$book || $book['ownerId'] !== SessionManager::get('user')['id']) {
            throw new UnauthorizedActionException('Impossible de modifier ce livre.');
        }

        if ($this->isSubmit('update-book-submit')) {
            $data = $this->getRequest()->getParsedBody();
            $update = $this->processUpdateBook($data, $id);

            if ($update) {
                $this->addMessage('success', 'Livre modifié', 'Modification de votre livre effectué avec succès.');
            } else {
                $this->addMessage(
                    'error',
                    'Une erreur est survenue',
                    'Une erreur est survenue lors de la modification de votre livre'
                );
            }

            $this->locate('/account');
            return;
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

    /**
     * Met à jour les informations d'un livre dans la base de données
     * @param array $data
     * @param int $id
     * @return bool
     * @throws FileUploadError
     */
    private function processUpdateBook(array $data, int $id) : bool
    {
        unset($data['update-book-submit']);

        if (isset($_FILES['cover']) && $_FILES["cover"]["size"] !== 0) {
            $data['cover'] = FileUploader::upload($_FILES["cover"], 100);
        } else {
            unset($data['cover']);
        }

        return new BookRepository()->update($data, ['id', $id]);
    }
}
