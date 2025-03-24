<?php

declare(strict_types = 1);

namespace App\Repository;

use App\Util\Sql;
use PDO;

abstract class MainRepository extends Sql
{
    public function __construct(protected string $table)
    {
    }

    /**
     * Récupère toutes les entrées d'une table
     * @param string|null $orderBy
     * @param int|null $limit
     * @return array|null
     */
    public function findAll(?string $orderBy = 'ID DESC', ?int $limit = null) : array|null
    {
        $queryOrderBy = $orderBy !== null ? 'ORDER BY ' . $orderBy : '';
        $queryLimit = $limit !== null ? 'LIMIT ' . $limit : '';

        $query = Sql::bdd()->prepare("SELECT * FROM {$this->table} {$queryOrderBy} {$queryLimit}");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Recherche toutes les entrées selon un critère de sélection
     * @param array $where
     * @param bool $strict
     * @param string|null $orderBy
     * @param string|null $limit
     * @return array|null
     */
    public function findBy(
        array $where,
        bool $strict = true,
        ?string $orderBy = 'ID DESC',
        ?string $limit = null
    ) : array|null {
        $queryOrderBy = $orderBy !== null ? 'ORDER BY ' . $orderBy : '';
        $queryLimit = $limit !== null ? 'LIMIT ' . $limit : '';
        $queryWhere = $strict ? 'WHERE ' . $where[0] . ' = "' . $where[1]. '"' : 'WHERE ' . $where[0] . ' LIKE "%' . $where[1] . '%"';

        $query = Sql::bdd()->prepare("SELECT * FROM {$this->table} {$queryWhere} {$queryOrderBy} {$queryLimit}");
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
     * Modifie une entrée dans une table
     * @param array $data
     * @param array $where
     * @return bool
     */
    public function update(array $data, array $where) : bool
    {
        $fields = [];
        foreach($data as $field => $value) {
            $fields[] = $field . ' = :' . $field;
        }

        $sql = "UPDATE {$this->table} SET " . implode(', ', $fields) . " WHERE {$where[0]} = {$where[1]}";
        $query = Sql::bdd()->prepare($sql);

        foreach($data as $field => $value) {
            $query->bindValue(':' . $field, $value);
        }

        return $query->execute();
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
