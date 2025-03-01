<?php

declare(strict_types = 1);

namespace App\Entity;

class User extends MainEntity
{
    public int    $id;
    public string $username;
    public string $email;
    public string $password;
}
