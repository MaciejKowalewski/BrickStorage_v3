<?php

namespace App\Service;
use App\Repository\WishRepository;
use Doctrine\ORM\EntityManagerInterface;

class WishlistProvider{

    public function __construct(
        protected WishRepository $wishRepository,
        protected EntityManagerInterface $entityManagerInterface,
    ){}
    public function delete(string $id): void{
        $wish = $this->wishRepository->find($id);
        $this->entityManagerInterface->remove($wish);
        $this->entityManagerInterface->flush();
    }

    public function edit(string $id, $wish, $form): void{
        $wish->setSetId($form->get('SetId')->getData());
        $wish->setName($form->get('Name')->getData());
        $wish->setImagePath($form->get('ImagePath')->getData());
        $wish->setPromoklockiSRC($form->get('PromoklockiSRC')->getData());
        $wish->setEolYear($form->get('EolYear')->getData());
        $this->entityManagerInterface->flush();
    }

    public function add(): void{

    }
}