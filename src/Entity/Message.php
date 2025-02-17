<?php

namespace App\Entity;

use DateTime;

class Message
{
    public int $id;
    public int $ownerId;
    public int $receiverId;
    public DateTime $date;
    public string $content;
}
