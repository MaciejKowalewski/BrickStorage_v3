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
        $transformedDAta = $this->wishlistProvider->transformDataForTwig($request, $form);
        
        return $this->render('wish/index.html.twig', [
            'Wishlist' => $transformedDAta['wishlist'],
            'form' => $form,
            'page' => $transformedDAta['page'],
            'PagiantorPerPage' => WishRepository::PAGINATOR_PER_PAGE,
        ]);
    }

    #[Route('/newwish', name: 'add_newwish')]
    public function add(Request $request): Response
    {
        $wish = new Wish;
        $form = $this->createForm(AddWishType::class, $wish);
        $form->handleRequest($request);  
        $message = '';

         if ($form->isSubmitted() and $form->isValid()) {
            if($this->wishlistProvider->add($form)[0]){
                $this->wishlistProvider->add($form);
                return $this->redirectToRoute('wishlist');
            }else{
                $message = $this->wishlistProvider->add($form)[1];
            }
         }
        return $this->render('wish/addWish.html.twig', [
            'form' => $form,
            'message' => $message,
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
