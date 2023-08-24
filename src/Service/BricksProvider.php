<?php

namespace App\Service;

use App\Entity\Brick;
use Symfony\Component\Form\Form;
use App\Repository\BrickRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class BricksProvider extends AbstractProvider{

    public function __construct(
        private BrickRepository $BrickRepository,
        private EntityManagerInterface $entityManagerInterface,
    )
    {}

    public function transformDataForTwig(Request $request, string $sortBy, string $search=''): array{
        $page = $request->query->getInt('page', 0);
        $offset = $this->paginatorPerPage*$page;
        $bricks = $this->BrickRepository->paginateBricks($search,$sortBy, $offset, $this->paginatorPerPage);
        return array('bricks'=>$bricks, 'page'=>$page, 'paginatorPerPage'=>$this->paginatorPerPage);
    }  

    public function edit(): void{
        $this->entityManagerInterface->flush();
    }

    public function delete(string $id): void{
        $brick = $this->BrickRepository->find($id);
        $this->entityManagerInterface->remove($brick);
        $this->entityManagerInterface->flush();
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
        if(!$this->isBrickInDatabase($newBrick, $this->BrickRepository)){
            $this->entityManagerInterface->persist($newBrick);
            $this->entityManagerInterface->flush();
        }else{
            $this->editBricksQuantity($newBrick, $form);
        }
    }
}