<?php

namespace App\Service;

use App\Entity\Brick;
use App\Repository\BrickRepository;
use Doctrine\ORM\EntityManagerInterface;

class BricksProvider{

    public function __construct(
        private BrickRepository $BrickRepository,
        private EntityManagerInterface $entityManagerInterface,
    )
    {}

    public function transformDataForTwig($request, $form): array{
        $form->handleRequest($request);
        $page = $request->query->getInt('page', 0);
        if ($form->isSubmitted() && $form->isValid()) { 
            $search = $request->query->all()['bricks_paginator']['search'];
            $sortBy = $request->query->all()['bricks_paginator']['sortBy'];
            $bricks = $this->BrickRepository->paginateBricks($search,$sortBy, BrickRepository::PAGINATOR_PER_PAGE*$page);
        }else{
            $bricks = $this->BrickRepository->paginateBricks('','BrickId_ASC', BrickRepository::PAGINATOR_PER_PAGE*$page);
        }
        return array('bricks'=>$bricks, 'page'=>$page);
    }  

    public function edit($brick, $form): void{
        $brick->setBrickId($form->get('BrickId')->getData());
        $brick->setName($form->get('Name')->getData());
        $brick->setImagePath($form->get('ImagePath')->getData());
        $brick->setQuantity($form->get('Quantity')->getData());
        $brick->setBricklinkSRC($form->get('BricklinkSRC')->getData());
        $brick->setColor($form->get('Color')->getData());
        $brick->setPartType($form->get('PartType')->getData());
        $this->entityManagerInterface->flush();
    }

    public function delete(string $id): void{
        $brick = $this->BrickRepository->find($id);
        $this->entityManagerInterface->remove($brick);
        $this->entityManagerInterface->flush();
    }

    private function isInDatabase($newBrick): Bool{
        $isBrick = $this->BrickRepository->findBy(
            ['BrickId' => $newBrick->getBrickId(),
            'Color' => $newBrick->getColor()]
            );
        return !empty($isBrick);
    }

    private function editBricksQuantity($newBrick, $form){
        $BrickId = $this->BrickRepository->findOneBy(
            ['BrickId' => $newBrick->getBrickId(),
            'Color' => $newBrick->getColor()]
            );
        $BrickId->setQuantity(
            $BrickId->getQuantity()+$form->get('Quantity')->getData()
        );
        $this->entityManagerInterface->flush();
    }

    public function add($form): void{
        $newBrick = $form->getData();
        if(!$this->isInDatabase($newBrick)){
            $this->entityManagerInterface->persist($newBrick);
            $this->entityManagerInterface->flush();
        }else{
            $this->editBricksQuantity($newBrick, $form);
        }
    }
}