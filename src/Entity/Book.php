<?php

declare(strict_types = 1);

namespace App\Entity;

use DateTime;

class Book extends MainEntity
{
    public int             $id;
    public string          $title;
    public string          $author;
    public string          $description;
    public string          $cover;
    public bool            $state;
    public int             $ownerId;
    public string|DateTime $createdAt;
}
