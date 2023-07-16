<?php

namespace App\Service;
use App\Repository\WishRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\WishlistPaginator;

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

    public function edit($wish, $form): void{
        $wish->setSetId($form->get('SetId')->getData());
        $wish->setName($form->get('Name')->getData());
        $wish->setImagePath($form->get('ImagePath')->getData());
        $wish->setPromoklockiSRC($form->get('PromoklockiSRC')->getData());
        $wish->setEolYear($form->get('EolYear')->getData());
        $this->entityManagerInterface->flush();
    }

    private function isInDatabase($newWish): Bool{
        $isSet = $this->wishRepository->findBy(['SetId' => $newWish->getSetId()]);
        return empty($isSet);
    }

    public function add($form): array{
        $newWish = $form->getData();
        if($this->isInDatabase($newWish)){
            $this->entityManagerInterface->persist($newWish);
            $this->entityManagerInterface->flush();
            return [1];
        }else{
            return [0,'Zestaw już został dodany do listy życzeń!'];
        }
    }

    public function transformDataForTwig($request, $form): array{
        $form->handleRequest($request);
        $page = $request->query->getInt('page', 0);
        if ($form->isSubmitted() && $form->isValid()) { 
            $search = $request->query->all()['wishlist_paginator']['search'];
            $sortBy = $request->query->all()['wishlist_paginator']['sortBy'];
            $wishlist = $this->wishRepository->paginateWishes($search,$sortBy, WishRepository::PAGINATOR_PER_PAGE*$page);
        }else{
            $wishlist = $this->wishRepository->paginateWishes('','SetId_ASC', WishRepository::PAGINATOR_PER_PAGE*$page);
        }
        return array('wishlist'=>$wishlist, 'page'=>$page);
    }
}