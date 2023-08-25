<?php

namespace App\Service;

use App\Entity\Minifigure;
use App\Repository\MinifigureRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Service\Scraper;
use App\Entity\Quantity;
use App\Entity\Brick;
use App\Service\BricksProvider;
use App\Repository\BrickRepository;
use App\Repository\QuantityRepository;
use App\Service\RequiredParameter;
use Symfony\Component\Form\Form;


class MinifiguresProvider extends AbstractProvider{

    public function __construct(
        private MinifigureRepository $minifigureRepository,
        private EntityManagerInterface $entityManagerInterface,
        private Scraper $scraper,
        private BricksProvider $bricksProvider,
        private BrickRepository $brickRepository,
        private QuantityRepository $quantityRepository,
    )
    {}

    public function transformDataForTwig($request, $sortBy, $search=''): array{
        $page = $request->query->getInt('page', 0);
        $minifigs = $this->minifigureRepository->paginateMinifigures($search,$sortBy, MinifigureRepository::PAGINATOR_PER_PAGE*$page);
        return array('minifigs'=>$minifigs, 'page'=>$page);
    }  

    public function edit(EntityManagerInterface $entityManagerInterface, Minifigure $minifigure = new RequiredParameter(), Form $form = new RequiredParameter()): void{
        $bricks = $this->getMinifiguresBricks($minifigure->getId(), $this->quantityRepository);
        $unitBrick = $this->brickRepository->findOneBy(['BrickId' => $form->get('minifigId')->getData().' unitBrick']);
        $newQuantity = $form->get('quantity')->getData();
        foreach($bricks as $brick){
            $brick->setQuantity($brick->getQuantity()+$newQuantity-$unitBrick->getQuantity());
        }
        $entityManagerInterface->flush();        
    }

    private function isInDatabase($newMinifigure): Bool{
        $isMinifigure = $this->minifigureRepository->findBy(
            ['minifigId' => $newMinifigure->getMinifigId()]
            );
        return !empty($isMinifigure);
    }

    private function editMinifiguresQuantity($newMinifigure, $form){
        $MinifigureId = $this->minifigureRepository->findOneBy(
            ['minifigId' => $newMinifigure->getMinifigId()]
            );
        $MinifigureId->setQuantity(
            $MinifigureId->getQuantity()+$form->get('quantity')->getData()
        );
    }

    private function getBrick($newMinifig,$brickProperties): Brick{
        $brick = new Brick();
        $brick->setBrickId($brickProperties['el_id']);
        $brick->setName($brickProperties['name']);
        $brick->setQuantity($brickProperties['quantity']*$newMinifig->getQuantity());
        $brick->setBrickLinkSRC($brickProperties['link']);
        $brick->setImagePath($brickProperties['img_link']);
        $brick->setColor($brickProperties['color']);
        $brick->setPartType($brickProperties['part_type']);
        return $brick;
    }

    private function addBrickToMinifig($minifigId, $newMinifig){
        $this->scraper->scrap($minifigId,'m');
        $scrapedBricks = $this->scraper->get_parts();
        foreach($scrapedBricks as $brickProperties){
            $brick = $this->getBrick($newMinifig, $brickProperties);
            $quan = new Quantity();
            if($this->isBrickInDatabase($brick, $this->brickRepository)){
                $BrickId = $this->brickRepository->findOneBy(
                    ['BrickId' => $brick->getBrickId(),
                    'Color' => $brick->getColor()]
                    );
                $BrickId->setQuantity($BrickId->getQuantity()+$brick->getQuantity());
                $quan->setBrickID($BrickId);
                unset($brick);
            }else{
                $this->entityManagerInterface->persist($brick);
                $quan->setBrickID($brick);
            }
            $quan->setQuantity($brickProperties['quantity']);
            $quan->setMinifigureID($newMinifig);
            $this->entityManagerInterface->persist($quan);
        }
        $unitBrick = new Brick();
        $unitBrick->setBrickId($newMinifig->getMinifigId().' unitBrick');
        $unitBrick->setName('unitBrick');
        $unitBrick->setQuantity($newMinifig->getQuantity());
        $unitBrick->setBrickLinkSRC('unitBrick');
        $unitBrick->setImagePath('unitBrick');
        $unitBrick->setColor('unitBrick');
        $unitBrick->setPartType('unitBrick');
        $quan = new Quantity();
        $quan->setQuantity(1);
        $quan->setBrickID($unitBrick);
        $quan->setMinifigureID($newMinifig);
        $this->entityManagerInterface->persist($quan);
        $this->entityManagerInterface->persist($unitBrick);
    }

    public function add($form): void{
        $newMinifigure = $form->getData();
        if(!$this->isInDatabase($newMinifigure)){
            $this->entityManagerInterface->persist($newMinifigure);
            $this->addBrickToMinifig($form->get('minifigId')->getData(), $newMinifigure);
            $this->entityManagerInterface->flush();
        }else{
            $this->addBrickToMinifig($form->get('minifigId')->getData(), $newMinifigure);
            $this->editMinifiguresQuantity($newMinifigure, $form);
            $this->entityManagerInterface->flush();
        }
    }
}