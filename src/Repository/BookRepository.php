<?php

declare(strict_types = 1);

namespace App\Repository;

use App\Entity\Book;
use App\Util\Sql;

class BookRepository extends MainRepository
{
    public function __construct()
    {
        parent::__construct('book');
    }

    /**
     * Ajoute un nouveau livre à la base de données
     * @param Book $book
     * @return bool
     */
    public function addBook(Book $book) : bool
    { // je t'aime
        $request = "
            INSERT INTO {$this->table} (title, author, description, cover, state, owner_id)
            VALUES (:title, :author, :description, :cover, :state, :ownerId)
        ";
        $query = Sql::bdd()->prepare($request);
        $query->bindParam(':title', $book->title);
        $query->bindParam(':author', $book->author);
        $query->bindParam(':description', $book->description);
        $query->bindParam(':cover', $book->cover);
        $query->bindParam(':state', $book->state, \PDO::PARAM_BOOL);
        $query->bindParam(':ownerId', $book->ownerId, \PDO::PARAM_INT);

        $query->execute();
        return $query->rowCount() > 0;
    }
}
