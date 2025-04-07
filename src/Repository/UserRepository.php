<?php

namespace App\Repository;

use App\Entity\User;
use App\Util\Sql;
use DateTime;
use PDO;

class UserRepository extends MainRepository
{
    public function __construct()
    {
        parent::__construct('user');
    }

    /**
     * Créer un nouvel utilisateur
     * @param User $user
     * @return bool|string
     */
    public function addUser(User $user) : bool|string
    {
        $hashPassword = password_hash($user->password, PASSWORD_DEFAULT);
        $date = new DateTime()->format('Y-m-d H:i:s');

        $request = "
            INSERT INTO {$this->table} (username, email, password, inscriptionDate)
            VALUES (:username, :email, :password, :inscriptionDate)
        ";
        $query = Sql::bdd()->prepare($request);
        $query->bindParam(':username', $user->username);
        $query->bindParam(':email', $user->email);
        $query->bindParam(':password', $hashPassword);
        $query->bindParam(':inscriptionDate', $date);

        $query->execute();
        return Sql::bdd()->lastInsertId();
    }

    /**
     * Récupère une seule entrée en fonction d'un email
     * @param string $email
     * @return User|null
     */
    public function findOneByEmail(string $email) : ?User
    {
        $query = Sql::bdd()->prepare("SELECT * FROM {$this->table} WHERE email = :email LIMIT 1");
        $query->bindParam(':email', $email);
        $query->execute();

        $user = $query->fetch(PDO::FETCH_ASSOC);

        if($user) {
            return new User($user);
        }

        return null;
    }
}
