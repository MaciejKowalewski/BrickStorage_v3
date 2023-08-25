<?php

namespace App\Service;
use App\Repository\BrickRepository;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Brick;
use Doctrine\ORM\EntityManagerInterface;

abstract class AbstractProvider{

    public function __construct(
        private BrickRepository $brickRepository,
    )
    {}

    protected $paginatorPerPage = 20;

    abstract public function transformDataForTwig(Request $request, string $sortBy, string $search='') : array;
    abstract public function add(Form $form) : void;

    public function edit(EntityManagerInterface $entityManagerInterface): void{
        $entityManagerInterface->flush();
    }

    public function delete(string $id, $repository, $entityManagerInterface): void{
        $entity = $repository->find($id);
        $entityManagerInterface->remove($entity);
        $entityManagerInterface->flush();
    }

    protected function isBrickInDatabase(Brick $brick, BrickRepository $repository): Bool{
        $brickFromDB = $repository->findBy(
            ['BrickId' => $brick->getBrickId(),
            'Color' => $brick->getColor()]
            );
        return !empty($brickFromDB);
    }

    public function getMinifiguresBricks(string $id, $repository): array{
        $bricksIds = [];
        $bricks = $repository->findBy(['MinifigureID' => $id]);
        foreach($bricks as $brick){
            $bricksIds[] = $brick->getBrickID();
        }
        return $bricksIds;
    }
}