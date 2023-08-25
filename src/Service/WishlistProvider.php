<?php

namespace App\Service;
use App\Repository\WishRepository;
use App\Entity\Wish;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class WishlistProvider extends AbstractProvider{

    public function __construct(
        private WishRepository $wishRepository,
        private EntityManagerInterface $entityManagerInterface,
    ){}

    public function transformDataForTwig(Request $request, string $sortBy, string $search=''): array{
        $page = $request->query->getInt('page', 0);
        $offset = $this->paginatorPerPage*$page;
        $wishlist = $this->wishRepository->paginateWishes($search,$sortBy, $offset, $this->paginatorPerPage);
        return array('wishlist'=>$wishlist, 'page'=>$page, 'paginatorPerPage'=>$this->paginatorPerPage);
    }

    public function add($form): void{
        $newWish = $form->getData();
        if(!$this->isInDatabase($newWish)){
            $this->entityManagerInterface->persist($newWish);
            $this->entityManagerInterface->flush();
        }
    }

    private function isInDatabase(Wish $newWish): Bool{
        $isSet = $this->wishRepository->findBy(['SetId' => $newWish->getSetId()]);
        return !empty($isSet);
    }
}