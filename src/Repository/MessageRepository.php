<?php

namespace App\Repository;

use App\Entity\Message;
use App\Util\Sql;
use DateTime;
use PDO;

class MessageRepository extends MainRepository
{
    public function __construct()
    {
        parent::__construct('message');
    }

    /**
     * Charge la liste des conversations d'un utilisateur
     * @param int $id
     * @return bool|array
     */
    public function fetchDiscussions(int $id) : bool|array
    {
        $query = Sql::bdd()->prepare(
            "
            SELECT m.*, u.username, u.avatar
            FROM message m
            JOIN (
                SELECT ownerId, MAX(date) AS max_date
                FROM message
                WHERE receiverId = :receiverId
                GROUP BY ownerId
            ) latest_messages
            ON m.ownerId = latest_messages.ownerId AND m.date = latest_messages.max_date
            JOIN user u ON m.ownerId = u.id
            WHERE m.receiverId = :receiverId
            ORDER BY m.date DESC
        "
        );
        $query->bindValue(':receiverId', $id, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Retrouve la conversation entre deux utilisateurs
     * @param int $owner
     * @param int $receiver
     * @return bool|array
     */
    public function fetchMessages(int $owner, int $receiver) : bool|array
    {
        $query = Sql::bdd()->prepare(
            "
            SELECT *
            FROM message
            WHERE (ownerId = :user1 AND receiverId = :user2)
               OR (ownerId = :user2 AND receiverId = :user1)
            ORDER BY date ASC
        "
        );

        $query->bindValue(':user1', $owner, PDO::PARAM_INT);
        $query->bindValue(':user2', $receiver, PDO::PARAM_INT);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function send(Message $message) : bool
    {
        $date = new DateTime()->format('Y-m-d H:i:s');

        $query = Sql::bdd()->prepare("
            INSERT INTO message (ownerId, receiverId, date, content)
            VALUES (:ownerId, :receiverId, :date, :content)
        ");

        $query->bindValue(':ownerId', $message->ownerId, PDO::PARAM_INT);
        $query->bindValue(':receiverId', $message->receiverId, PDO::PARAM_INT);
        $query->bindValue(':date', $date);
        $query->bindValue(':content', $message->content);

        return $query->execute();
    }
}
