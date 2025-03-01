<?php

declare(strict_types = 1);

namespace App\Entity;

class Book extends MainEntity
{
    public int    $id;
    public string $title;
    public string $author;
    public string $description;
    public string $cover;
    public bool   $state;
    public int    $ownerId;
}
