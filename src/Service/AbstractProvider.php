<?php

namespace App\Service;
use App\Repository\BrickRepository;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Wish;
use App\Entity\Brick;

abstract class AbstractProvider{

    public function __construct(
        private BrickRepository $brickRepository,
    )
    {}

    protected $paginatorPerPage = 20;

    abstract public function transformDataForTwig(Request $request, string $sortBy, string $search='') : array;
    abstract public function add(Form $form) : void;
    abstract public function edit() : void;
    abstract public function delete(string $id) : void;

    protected function isBrickInDatabase(Brick $brick, BrickRepository $repository): Bool{
        $brickFromDB = $repository->findBy(
            ['BrickId' => $brick->getBrickId(),
            'Color' => $brick->getColor()]
            );
        return !empty($brickFromDB);
    }
}