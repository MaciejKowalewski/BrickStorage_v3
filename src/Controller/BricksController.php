<?php

namespace App\Controller;

use App\Entity\Brick;
use App\Repository\BrickRepository;
use App\Service\BricksProvider;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\BricksSearchType;
use App\Form\AddBrickType;
use Doctrine\ORM\EntityManagerInterface;

class BricksController extends AbstractController
{
    public function __construct(
        private BrickRepository $brickRepository,
        private BricksProvider $bricksProvider,
        private EntityManagerInterface $entityManagerInterface,
    )
    {}

    #[Route('/bricks', name: 'bricks')]
    public function index(Request $request): Response
    {
        $form = $this->createForm(BricksSearchType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) { 
            $search = $request->query->all()['bricks_search']['search'];
            $sortBy = $request->query->all()['bricks_search']['sortBy'];
        }else{
            $search = '';
            $sortBy = 'BrickId_ASC';
        }
        $transformedData = $this->bricksProvider->transformDataForTwig($request, $sortBy, $search);
        return $this->render('bricks/bricks.html.twig', [
            'Bricks' => $transformedData['bricks'],
            'form' => $form->createView(),
            'page' => $transformedData['page'],
            'PagiantorPerPage' => $transformedData['paginatorPerPage'],
        ]);
    }

    #[Route('/newbrick', name: 'add_newbrick')]
    public function add(Request $request): Response
    {
        $wish = new Brick;
        $form = $this->createForm(AddBrickType::class, $wish);
        $form->handleRequest($request);  
         if ($form->isSubmitted() and $form->isValid()) {
            $this->bricksProvider->add($form);
            return $this->redirectToRoute('bricks');
         }
        return $this->render('bricks/addBrick.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/brick/{id}', name: 'edit_brick')]
    public function edit($id,Request $request): Response
    {
        $brick = $this->brickRepository->find($id);
        $form = $this->createForm(AddBrickType::class, $brick);
        $form->handleRequest($request);  
         if ($form->isSubmitted() and $form->isValid()) {
            $this->bricksProvider->edit($this->entityManagerInterface);
            $routeName = $request->attributes->get('_route');
            return $this->redirectToRoute($routeName, ['id'=>$id]);
         }
        return $this->render('bricks/editBrick.html.twig', [
            'brick' => $brick,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/brick/delete/{id}', name: 'delete_brick')]
    public function delete($id): Response
    {
        $this->bricksProvider->delete($id, $this->brickRepository, $this->entityManagerInterface);
        return $this->redirectToRoute('bricks');
    }
}
