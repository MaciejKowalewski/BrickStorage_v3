<?php

namespace App\Service;

use App\Entity\MainPageElement;
use App\Repository\MainPageElementRepository;
use Doctrine\ORM\EntityManagerInterface;

class MainPageProvider{

    public function __construct(
        private EntityManagerInterface $entityManagerInterface,
        private MainPageElementRepository $mainPageElementRepository
    )
    {}

    public function edit($element, $form): void{
        $element->setUrl($form->get('url')->getData());
        $element->setName($form->get('name')->getData());
        $element->setImagePath($form->get('imagePath')->getData());
        $this->entityManagerInterface->flush();
    }

    public function delete(string $id): void{
        $element = $this->mainPageElementRepository->find($id);
        $this->entityManagerInterface->remove($element);
        $this->entityManagerInterface->flush();
    }

    public function add($form): void{
        $newEl = $form->getData();
        $this->entityManagerInterface->persist($newEl);
        $this->entityManagerInterface->flush();
        
    }
}