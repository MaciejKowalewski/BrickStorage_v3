<?php

namespace App\Service;
use App\Repository\BrickRepository;
use Doctrine\ORM\EntityManagerInterface;

abstract class AbstractProvider{

    public function __construct(
        private BrickRepository $brickRepository,
        private EntityManagerInterface $entityManagerInterface,
    ){}

    abstract public function transformDataForTwig() : array;
    abstract public function add() : void;
    abstract public function edit() : void;
    abstract public function delete(string $id) : void;
}