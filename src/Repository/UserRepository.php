<?php

namespace App\Repository;

use App\Entity\User;
use App\Util\Sql;

class UserRepository extends MainRepository
{
    public function __construct()
    {
        parent::__construct('user');
    }

    /**
     * Créer un nouvel utilisateur
     * @param User $user
     * @return bool
     */
    public function addUser(User $user) : bool|string
    {
        $hashPassword = password_hash($user->password, PASSWORD_DEFAULT);

        $request = "
            INSERT INTO {$this->table} (username, email, password)
            VALUES (:username, :email, :password)
        ";
        $query = Sql::bdd()->prepare($request);
        $query->bindParam(':username', $user->username);
        $query->bindParam(':email', $user->email);
        $query->bindParam(':password', $hashPassword);

        $query->execute();
        return Sql::bdd()->lastInsertId();
    }
}
