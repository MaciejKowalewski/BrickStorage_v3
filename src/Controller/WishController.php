<?php

namespace App\Controller;

use App\Form\AddWishType;
use App\Entity\Wish;
use App\Repository\WishRepository;
use App\Service\WishlistProvider;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\WishlistPaginator;

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
        $transformedData = $this->wishlistProvider->transformDataForTwig($request, $form);
        
        return $this->render('wish/wishlist.html.twig', [
            'Wishlist' => $transformedData['wishlist'],
            'form' => $form,
            'page' => $transformedData['page'],
            'PagiantorPerPage' => $transformedData['paginatorPerPage'],
        ]);
    }

    #[Route('/newwish', name: 'add_newwish')]
    public function add(Request $request): Response
    {
        $wish = new Wish;
        $form = $this->createForm(AddWishType::class, $wish);
        $form->handleRequest($request);  

         if ($form->isSubmitted() and $form->isValid()) {
            $this->wishlistProvider->add($form);
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
            $this->wishlistProvider->edit($wish, $form);
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
