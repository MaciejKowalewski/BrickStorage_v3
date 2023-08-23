<?php

namespace App\Service;
use App\Repository\BrickRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Wish;

abstract class AbstractProvider{

    protected $paginatorPerPage = 20;
    protected $entityManagerInterface;

    public function __construct(
        private BrickRepository $brickRepository,
        EntityManagerInterface $entityManagerInterface,
    ){
        $this->entityManagerInterface = $entityManagerInterface;
    }

    abstract public function transformDataForTwig(Request $request, Form $form) : array;
    abstract public function add(Form $form) : void;
    abstract public function edit(Wish $wish,Form $form) : void;
    abstract public function delete(string $id) : void;
}