<?php

declare(strict_types = 1);

namespace App\Entity;

abstract class MainEntity
{
    /**
     * Permet d'hydrater les entités
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        if (!empty($data)) {
            foreach ($data as $key => $value) {
                if (property_exists($this, $key)) {
                    $this->$key = $value;
                }
            }
        }
    }
}
