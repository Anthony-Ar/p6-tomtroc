<?php

namespace App\Repository;

class MessageRepository extends MainRepository
{
    public function __construct()
    {
        parent::__construct('message');
    }

}
