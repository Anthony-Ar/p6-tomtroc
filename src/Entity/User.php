<?php

declare(strict_types = 1);

namespace App\Entity;

use DateTime;

class User extends MainEntity
{
    public int      $id;
    public string   $username;
    public string   $email;
    public string   $password;
    public DateTime $inscriptionDate;
    public string   $avatar;
}
