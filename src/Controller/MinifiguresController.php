<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\MinifigureRepository;
use App\Service\MinifiguresProvider;
use App\Form\MinifiguresSearchType;
use App\Form\AddMinifigureType;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Minifigure;
use App\Service\Scraper;
use Doctrine\ORM\EntityManagerInterface;

class MinifiguresController extends AbstractController
{
    public function __construct(
        private MinifigureRepository $minifigureReposytory,
        private MinifiguresProvider $minifiguresProvider,
        private Scraper $scraper,
        private EntityManagerInterface $entityManagerInterface,
    )
    {}

    #[Route('/minifigures', name: 'minifigures')]
    public function index(Request $request): Response
    {
        $form = $this->createForm(MinifiguresSearchType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) { 
            $search = $request->query->all()['minifigures_search']['search'];
            $sortBy = $request->query->all()['minifigures_search']['sortBy'];
        }else{
            $search = '';
            $sortBy = 'MinifigureId_ASC';
        }
        $transformedData = $this->minifiguresProvider->transformDataForTwig($request, $sortBy, $search);
        return $this->render('minifigures/minifigures.html.twig', [
            'Minifigs' => $transformedData['minifigs'],
            'form' => $form,
            'page' => $transformedData['page'],
            'PagiantorPerPage' => MinifigureRepository::PAGINATOR_PER_PAGE,
        ]);
    }

    #[Route('/newminifigure', name: 'add_newminifigure')]
    public function add(Request $request): Response
    {
        $minifig = new Minifigure;
        $form = $this->createForm(AddMinifigureType::class, $minifig);
        $form->handleRequest($request);  

         if ($form->isSubmitted() and $form->isValid()) {
            $this->minifiguresProvider->add($form);
            return $this->redirectToRoute('minifigures');
         }
        return $this->render('minifigures/addMinifig.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/minifigure/delete/{id}', name: 'delete_minifigure')]
    public function delete($id): Response
    {
        $this->minifiguresProvider->delete($id, $this->minifigureReposytory, $this->entityManagerInterface);
        return $this->redirectToRoute('minifigures');
    }

    #[Route('/minifigure/{id}', name: 'edit_minifigure')]
    public function edit($id,Request $request): Response
    {
        $minifigure = $this->minifigureReposytory->find($id);
        $form = $this->createForm(AddMinifigureType::class, $minifigure);
        $form->handleRequest($request);  
        $test = [];
        if ($form->isSubmitted() and $form->isValid()) {
            $test = $this->minifiguresProvider->edit($this->entityManagerInterface, $minifigure, $form);
            $routeName = $request->attributes->get('_route');
            return $this->redirectToRoute($routeName, ['id'=>$id]);
        }
        return $this->render('minifigures/editMinifigure.html.twig', [
            'minifigure' => $minifigure,
            'form' => $form,
            'Bricks' => $this->minifiguresProvider->getMinifiguresBricks($id, $this->minifigureReposytory),
            'test' => $this->minifiguresProvider->edit($this->entityManagerInterface ,$minifigure, $form),
        ]);
    }
}
