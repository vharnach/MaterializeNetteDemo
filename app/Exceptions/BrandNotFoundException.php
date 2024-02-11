<?php

namespace App\Exceptions;

use Exception;

class BrandNotFoundException extends Exception
{
    public function __construct(
        private int $brandId
    )
    {
        parent::__construct();
    }

    public function getBrandId(): int
    {
        return $this->brandId;
    }
}