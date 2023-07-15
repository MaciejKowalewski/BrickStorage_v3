<?php

namespace App\Controller;

use App\Form\AddWishType;
use App\Entity\Wish;
use App\Form\WishlistPaginator;
use App\Repository\WishRepository;
use App\Service\WishlistProvider;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class WishController extends AbstractController
{
    public function __construct(
        private WishRepository $wishRepository,
        private WishlistProvider $wishlistProvider,
        private EntityManagerInterface $entityManagerInterface,
    )
    {}

    #[Route('/wishlist', name: 'wishlist')]
    public function index(Request $request): Response
    {
        $form = $this->createForm(WishlistPaginator::class);
        $form->handleRequest($request);
        $page = $request->query->getInt('page', 0);
        if ($form->isSubmitted() && $form->isValid()) { 
            $search = $request->query->all()['wishlist_paginator']['search'];
            $sortBy = $request->query->all()['wishlist_paginator']['sortBy'];
            $wishlist = $this->wishRepository->paginateWishes($search,$sortBy, WishRepository::PAGINATOR_PER_PAGE*$page);
        }else{
            $wishlist = $this->wishRepository->paginateWishes('','SetId_ASC', WishRepository::PAGINATOR_PER_PAGE*$page);
        }
        
        return $this->render('wish/index.html.twig', [
            'Wishlist' => $wishlist,
            'form' => $form,
            'page' => $page,
            'PagiantorPerPage' => WishRepository::PAGINATOR_PER_PAGE,
        ]);
    }

    #[Route('/newwish', name: 'add_newwish')]
    public function add(Request $request): Response
    {
        $wish = new Wish;
        $form = $this->createForm(AddWishType::class, $wish);
        $form->handleRequest($request);  

         if ($form->isSubmitted() and $form->isValid()) {
           $newWish = $form->getData();
           $this->entityManagerInterface->persist($newWish);
           $this->entityManagerInterface->flush();
           return $this->redirectToRoute('wishlist');
         }

        return $this->render('wish/addWish.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/wish/{id}', name: 'edit_wish')]
    public function edit($id,Request $request): Response
    {
        $wish = $this->wishRepository->find($id);
        $form = $this->createForm(AddWishType::class, $wish);
        $form->handleRequest($request);  

         if ($form->isSubmitted() and $form->isValid()) {
            $this->wishlistProvider->edit($id, $wish, $form);
            $routeName = $request->attributes->get('_route');
            return $this->redirectToRoute($routeName, ['id'=>$id]);
         }

        return $this->render('wish/editWish.html.twig', [
            'wish' => $wish,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/wish/delete/{id}', name: 'delete_wish')]
    public function delete($id): Response
    {
        $this->wishlistProvider->delete($id);
        return $this->redirectToRoute('wishlist');
    }

}
