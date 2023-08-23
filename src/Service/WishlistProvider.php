<?php

namespace App\Service;
use App\Repository\WishRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class WishlistProvider extends AbstractProvider{

    public function __construct(
        private WishRepository $wishRepository,
        private EntityManagerInterface $entityManagerInterface,
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

    public function transformDataForTwig(Request $request, string $sortBy, string $search=''): array{
        $page = $request->query->getInt('page', 0);
        $wishlist = $this->wishRepository->paginateWishes($search,$sortBy, $this->paginatorPerPage*$page, $this->paginatorPerPage);
        return array('wishlist'=>$wishlist, 'page'=>$page, 'paginatorPerPage'=>$this->paginatorPerPage);
    }
}