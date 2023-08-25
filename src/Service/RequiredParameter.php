<?php


namespace App\Service;



final class RequiredParameter extends \ArgumentCountError
{
    public function __construct()
    {
        // Nested hack
        throw $this;
    }
}