<?php

namespace App\Controller;

use App\Repository\BrickRepository;
use App\Service\BricksProvider;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\BricksPaginator;

class BricksController extends AbstractController
{

    public function __construct(
        private BrickRepository $BrickRepository,
        private BricksProvider $bricksProvider
    )
    {}

    #[Route('/bricks', name: 'show_bricks')]
    public function index(Request $request): Response
    {
        $form = $this->createForm(BricksPaginator::class);
        $form->handleRequest($request);
        $page = $request->query->getInt('page', 0);

        if ($form->isSubmitted() && $form->isValid()) { 
            $search = $request->query->all()['wishlist_paginator']['search'];
            $sortBy = $request->query->all()['wishlist_paginator']['sortBy'];
            $bricks = $this->BrickRepository->paginateBricks($search, $sortBy, brickRepository::PAGINATOR_PER_PAGE*$page);
        }else{
            $bricks = $this->BrickRepository->paginateBricks('','SetId_ASC', brickRepository::PAGINATOR_PER_PAGE*$page);
        }
        return $this->render('bricks/bricks.html.twig', [
            'Bricks' => $bricks,
            'form' => $form,
            'page' => $page,
            'PagiantorPerPage' => brickRepository::PAGINATOR_PER_PAGE,
        ]);
    }

    //#[Route('/wishlist', name: 'wishlist')]
    //public function index(Request $request): Response
    //{
    //    $form = $this->createForm(WishlistPaginator::class);
    //    $form->handleRequest($request);
    //    $page = $request->query->getInt('page', 0);
    //    if ($form->isSubmitted() && $form->isValid()) { 
    //        $search = $request->query->all()['wishlist_paginator']['search'];
    //        $sortBy = $request->query->all()['wishlist_paginator']['sortBy'];
    //        $wishlist = $this->wishRepository->paginateWishes($search,$sortBy,WishRepository::PAGINATOR_PER_PAGE*$page);
    //    }else{
    //        $wishlist = $this->wishRepository->paginateWishes('','SetId_ASC',WishRepository::PAGINATOR_PER_PAGE*$page);
    //    }
    //    
    //    return $this->render('wish/index.html.twig', [
    //        'Wishlist' => $wishlist,
    //        'form' => $form,
    //        'page' => $page,
    //        'PagiantorPerPage' => WishRepository::PAGINATOR_PER_PAGE,
    //    ]);
    //}
}
