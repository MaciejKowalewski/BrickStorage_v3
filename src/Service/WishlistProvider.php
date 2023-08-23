<?php

namespace App\Service;
use App\Repository\WishRepository;
use Symfony\Component\HttpFoundation\Request;

class WishlistProvider extends AbstractProvider{

    public function __construct(
        protected WishRepository $wishRepository,
    ){}

    public function delete(string $id): void{
        $wish = $this->wishRepository->find($id);
        $this->entityManagerInterface->remove($wish);
        $this->entityManagerInterface->flush();
    }

    public function edit($wish, $form): void{
        $this->entityManagerInterface->flush();
    }

    private function isInDatabase($newWish): Bool{
        $isSet = $this->wishRepository->findBy(['SetId' => $newWish->getSetId()]);
        return !empty($isSet);
    }

    public function add($form): void{
        $newWish = $form->getData();
        if(!$this->isInDatabase($newWish)){
            $this->entityManagerInterface->persist($newWish);
            $this->entityManagerInterface->flush();
        }
    }

    public function transformDataForTwig(Request $request, $form): array{
        $page = $request->query->getInt('page', 0);
        if($form->isSubmitted() && $form->isValid()){
            $search = $request->query->all()['wishlist_paginator']['search'];
            $sortBy = $request->query->all()['wishlist_paginator']['sortBy'];
            $wishlist = $this->wishRepository->paginateWishes($search,$sortBy, $this->paginatorPerPage*$page, $this->paginatorPerPage);
        }else{
            $wishlist = $this->wishRepository->paginateWishes('','SetId_ASC', $this->paginatorPerPage*$page, $this->paginatorPerPage);
        }
        
        return array('wishlist'=>$wishlist, 'page'=>$page, 'paginatorPerPage'=>$this->paginatorPerPage);
    }
}