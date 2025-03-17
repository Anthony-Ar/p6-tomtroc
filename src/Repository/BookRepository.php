<?php

declare(strict_types = 1);

namespace App\Repository;

use App\Entity\Book;
use App\Util\Sql;
use PDO;

class BookRepository extends MainRepository
{
    public function __construct()
    {
        parent::__construct('book');
    }

    /**
     * Surcharge de la fonction parente findOne() afin d'y associer
     * par jointure les détails sur le propriétaire du livre
     * @param int $id
     * @return array|bool
     */
    public function findOne(int $id) : array|bool
    {
        $query = Sql::bdd()->prepare("
            SELECT book.*, user.username AS username, user.avatar AS avatar
            FROM {$this->table}
            INNER JOIN user ON book.ownerId = user.id
            WHERE book.id = :id
        ");
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Surcharge de la fonction parente findAll() afin d'y associer
     * par jointure les détails sur le propriétaire du livre
     * @param string|null $orderBy
     * @param int|null $limit
     * @return array|null
     */
    public function findAll(?string $orderBy = 'ID DESC', int|null $limit = null) : array|null
    {
        $queryOrderBy = $orderBy !== null ? 'ORDER BY ' . $orderBy : '';
        $queryLimit = $limit !== null ? 'LIMIT ' . $limit : '';

        $query = Sql::bdd()->prepare("
            SELECT book.*, user.username AS username
            FROM {$this->table}
            INNER JOIN user ON book.ownerId = user.id
            {$queryOrderBy}
            {$queryLimit}
        ");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
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
