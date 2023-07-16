<?php

namespace App\Controller;

use App\Repository\BrickRepository;
use App\Service\BricksProvider;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\BricksPaginator;
use App\Form\AddBrickType;

class BricksController extends AbstractController
{

    public function __construct(
        private BrickRepository $brickRepository,
        private BricksProvider $bricksProvider
    )
    {}

    #[Route('/bricks', name: 'show_bricks')]
    public function index(Request $request): Response
    {
        $form = $this->createForm(BricksPaginator::class);
        $transformedData = $this->bricksProvider->transformDataForTwig($request, $form);
        return $this->render('bricks/bricks.html.twig', [
            'Bricks' => $transformedData['bricks'],
            'form' => $form,
            'page' => $transformedData['page'],
            'PagiantorPerPage' => brickRepository::PAGINATOR_PER_PAGE,
        ]);
    }

    #[Route('/brick/{id}', name: 'edit_brick')]
    public function edit($id,Request $request): Response
    {
        $brick = $this->brickRepository->find($id);
        $form = $this->createForm(AddBrickType::class, $brick);
        $form->handleRequest($request);  

         if ($form->isSubmitted() and $form->isValid()) {
            $this->bricksProvider->edit($brick, $form);
            $routeName = $request->attributes->get('_route');
            return $this->redirectToRoute($routeName, ['id'=>$id]);
         }

        return $this->render('bricks/editBrick.html.twig', [
            'brick' => $brick,
            'form' => $form->createView(),
        ]);
    }
}
