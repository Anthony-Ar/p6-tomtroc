<?php

declare(strict_types = 1);

namespace App\Repository;

use App\Util\Sql;
use PDO;

abstract class MainRepository extends Sql
{
    protected string $table;

    public function __construct(string $table)
    {
        $this->table = $table;
    }

    /**
     * Récupère toutes les entrées d'une table
     * @param string|null $orderBy
     * @param string|null $limit
     * @return array|null
     */
    public function findAll(?string $orderBy = 'ID DESC', ?string $limit = null) : array|null
    {
        $queryOrderBy = $orderBy !== null ? 'ORDER BY ' . $orderBy : '';
        $queryLimit = $limit !== null ? 'LIMIT ' . $limit : '';

        $query = Sql::bdd()->prepare("SELECT * FROM {$this->table} {$queryOrderBy} {$queryLimit}");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère une seule entrée en fonction d'un ID
     * @param int $id
     * @return array|bool
     */
    public function findOne(int $id) : array|bool
    {
        $query = Sql::bdd()->prepare("SELECT * FROM {$this->table} WHERE id = :id LIMIT 1");
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Supprime une entrée
     * @param int $id
     * @return void
     */
    public function delete(int $id) : void
    {
        $query = Sql::bdd()->prepare("DELETE FROM {$this->table} WHERE id = :id");
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();
    }
}
