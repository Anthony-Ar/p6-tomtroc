<?php

declare(strict_types = 1);

namespace App\Entity;

use DateTime;

class Message extends MainEntity
{
    public int      $id;
    public int      $ownerId;
    public int      $receiverId;
    public DateTime $date;
    public string   $content;
}
