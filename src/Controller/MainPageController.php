<?php

namespace App\Controller;

use App\Entity\MainPageElement;
use App\Form\AddMainPageElementType;
use App\Repository\MainPageElementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\MainPageProvider;
use Symfony\Component\HttpFoundation\Request;

class MainPageController extends AbstractController
{
    public function __construct(
        private MainPageProvider $mainPageProvider,
        private MainPageElementRepository $mainPageElementRepository,
    )
    {}

    #[Route('/', name: '/')]
    public function index(): Response
    {
        $elements = $this->mainPageElementRepository->findAll();
        return $this->render('main_page/mainPage.html.twig', [
            'elements' => $elements,
        ]);
    }

    #[Route('/el/{id}', name: 'edit_element')]
    public function edit($id, Request $request): Response
    {
        $element = $this->mainPageElementRepository->find($id);
        $form = $this->createForm(AddMainPageElementType::class, $element);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) { 
            $this->mainPageProvider->edit($element, $form);
            $routeName = $request->attributes->get('_route');
            return $this->redirectToRoute($routeName, ['id'=>$id]);
        }
        return $this->render('main_page/editElement.html.twig', [
            'element' => $element,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/el/delete/{id}', name: 'delete_element')]
    public function delete($id): Response
    {
        $this->mainPageProvider->delete($id);
        return $this->redirectToRoute('/');
    }

    #[Route('/newElement', name: 'add_Element')]
    public function add(Request $request): Response
    {
        $wish = new MainPageElement;
        $form = $this->createForm(AddMainPageElementType::class, $wish);
        $form->handleRequest($request);  

         if ($form->isSubmitted() and $form->isValid()) {
            $this->mainPageProvider->add($form);
            return $this->redirectToRoute('/');
         }
        return $this->render('main_page/addElement.html.twig', [
            'form' => $form,
        ]);
    }
}
