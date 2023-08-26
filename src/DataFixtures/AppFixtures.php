<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Brick;
use App\Entity\Wish;
use App\Entity\MainPageElement;
use App\Entity\Minifigure;
use App\Entity\Quantity;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $brick1 = new Brick();
        $brick1->setBrickId(50946);
        $brick1->setName('Vehicle, Grille 1 x 2 x 2 2/3 Sloping');
        $brick1->setQuantity(2);
        $brick1->setBrickLinkSRC('https://www.bricklink.com/v2/catalog/catalogitem.page?P=50946&C=11#T=S&C=11&O={"color":"11","ss":"PL","loc":"PL","rpp":"500","iconly":0}');
        $brick1->setImagePath('https://img.bricklink.com/ItemImage/PN/11/50946.png');
        $brick1->setColor('Black');
        $brick1->setPartType('brick');
        $manager->persist($brick1);

        $brick2 = new Brick();
        $brick2->setBrickId(52036);
        $brick2->setName('Vehicle, Base 4 x 12 x 3/4 with 4 x 2 Recessed Center with Smooth Underside');
        $brick2->setQuantity(5);
        $brick2->setBrickLinkSRC('https://www.bricklink.com/v2/catalog/catalogitem.page?P=52036&C=85#T=S&C=85&O={"color":"85","ss":"PL","loc":"PL","rpp":"500","iconly":0}');
        $brick2->setImagePath('https://img.bricklink.com/ItemImage/PN/85/52036.png');
        $brick2->setColor('Dark bluish Gray');
        $brick2->setPartType('brick');
        $manager->persist($brick2);

        $brick3 = new Brick();
        $brick3->setBrickId(18892);
        $brick3->setName('Brick, Modified 2 x 4 with Wheels Holder with 2 x 2 Cutout and Hole');
        $brick3->setQuantity(15);
        $brick3->setBrickLinkSRC('https://www.bricklink.com/v2/catalog/catalogitem.page?P=18892&C=11#T=S&C=11&O={"color":"11","rpp":"500","iconly":0}');
        $brick3->setImagePath('https://img.bricklink.com/ItemImage/PN/11/18892.png');
        $brick3->setColor('Black');
        $brick3->setPartType('brick');
        $manager->persist($brick3);

        $brick4 = new Brick();
        $brick4->setBrickId(35789);
        $brick4->setName('Vehicle, Mudguard 4 x 2 1/2 x 2 with Arch Round, Solid Studs, and Rounded Legs');
        $brick4->setQuantity(3);
        $brick4->setBrickLinkSRC('https://www.bricklink.com/v2/catalog/catalogitem.page?P=35789&C=11#T=S&C=11&O={"color":"11","rpp":"500","iconly":0}');
        $brick4->setImagePath('https://img.bricklink.com/ItemImage/PN/11/35789.png');
        $brick4->setColor('Black');
        $brick4->setPartType('brick');
        $manager->persist($brick4);

        $brick5 = new Brick();
        $brick5->setBrickId(98281);
        $brick5->setName('Wedge 6 x 4 x 2/3 Quad Curved');
        $brick5->setQuantity(1);
        $brick5->setBrickLinkSRC('https://www.bricklink.com/v2/catalog/catalogitem.page?P=98281&C=11#T=S&C=11&O={"color":"11","rpp":"500","iconly":0}');
        $brick5->setImagePath('https://img.bricklink.com/ItemImage/PN/11/98281.png');
        $brick5->setColor('Black');
        $brick5->setPartType('brick');
        $manager->persist($brick5);

        $brick6 = new Brick();
        $brick6->setBrickId(43719);
        $brick6->setName('Wedge, Plate 4 x 4');
        $brick6->setQuantity(5);
        $brick6->setBrickLinkSRC('https://www.bricklink.com/v2/catalog/catalogitem.page?P=43719&C=11#T=S&C=11&O={"color":"11","rpp":"500","iconly":0}');
        $brick6->setImagePath('https://img.bricklink.com/ItemImage/PN/11/43719.png');
        $brick6->setColor('Black');
        $brick6->setPartType('brick');
        $manager->persist($brick6);

        $brick9 = new Brick();
        $brick9->setBrickId(50943);
        $brick9->setName('Vehicle, Air Scoop Engine Top 2 x 2');
        $brick9->setQuantity(1);
        $brick9->setBrickLinkSRC('https://www.bricklink.com/v2/catalog/catalogitem.page?P=50943&C=86#T=S&C=86&O={"color":"86","rpp":"500","iconly":0}');
        $brick9->setImagePath('https://img.bricklink.com/ItemImage/PN/86/50943.png');
        $brick9->setColor('Light Bluish Gray');
        $brick9->setPartType('brick');
        $manager->persist($brick9);

        $brick10 = new Brick();
        $brick10->setBrickId(3622);
        $brick10->setName('Brick 1 x 3');
        $brick10->setQuantity(56);
        $brick10->setBrickLinkSRC('https://www.bricklink.com/v2/catalog/catalogitem.page?P=3622&C=3#T=S&C=3&O={"color":"3","rpp":"500","iconly":0}');
        $brick10->setImagePath('https://img.bricklink.com/ItemImage/PN/3/3622.png');
        $brick10->setColor('Yellow');
        $brick10->setPartType('brick');
        $manager->persist($brick10);

        $brick11 = new Brick();
        $brick11->setBrickId(29634);
        $brick11->setName('Minifigure, Hair Female Very Curly, Parted in Middle');
        $brick11->setQuantity(1);
        $brick11->setBrickLinkSRC('https://www.bricklink.com/v2/catalog/catalogitem.page?P=29634&idColor=11#T=C&C=11');
        $brick11->setImagePath('https://img.bricklink.com/ItemImage/PN/11/29634.png');
        $brick11->setColor('Black');
        $brick11->setPartType('Minifigure, Hair');
        $manager->persist($brick11);

        $brick12 = new Brick();
        $brick12->setBrickId('970c00');
        $brick12->setName('Hips and Legs Plain');
        $brick12->setQuantity(1);
        $brick12->setBrickLinkSRC('https://www.bricklink.com/v2/catalog/catalogitem.page?P=970c00&idColor=42#T=I&C=42');
        $brick12->setImagePath('https://img.bricklink.com/ItemImage/PN/42/970c00.png');
        $brick12->setColor('Medium Blue');
        $brick12->setPartType('Minifigure, Legs');
        $manager->persist($brick12);

        $brick13 = new Brick();
        $brick13->setBrickId('973pb2341c01');
        $brick13->setName('Torso Female Open Jacket with 4 Buttons, Silver Pendant Necklace, Lavender Shirt Pattern / Medium Lavender Arms / Yellow Hands');
        $brick13->setQuantity(1);
        $brick13->setBrickLinkSRC('https://www.bricklink.com/v2/catalog/catalogitem.page?P=973pb2341c01&idColor=157#T=I&C=157');
        $brick13->setImagePath('https://img.bricklink.com/ItemImage/PN/157/973pb2341c01.png');
        $brick13->setColor('Medium Lavender');
        $brick13->setPartType('Minifigure, Torso Assembly');
        $manager->persist($brick13);

        $unitBrick = new Brick();
        $unitBrick->setBrickId('twn385 unitBrick');
        $unitBrick->setName('unitBrick');
        $unitBrick->setQuantity(1);
        $unitBrick->setBrickLinkSRC('unitBrick');
        $unitBrick->setImagePath('unitBrick');
        $unitBrick->setColor('unitBrick');
        $unitBrick->setPartType('unitBrick');
        $manager->persist($unitBrick);

        $unitBrick2 = new Brick();
        $unitBrick2->setBrickId('twn424 unitBrick');
        $unitBrick2->setName('unitBrick');
        $unitBrick2->setQuantity(1);
        $unitBrick2->setBrickLinkSRC('unitBrick');
        $unitBrick2->setImagePath('unitBrick');
        $unitBrick2->setColor('unitBrick');
        $unitBrick2->setPartType('unitBrick');
        $manager->persist($unitBrick2);


//-------------------------------------------------------------------------------------------------------------------------------------------------------------

        $minifig = new Minifigure();
        $minifig->setMinifigId('twn385');
        $minifig->setName('Female, Bushy Black Hair, Medium Lavender Jacket on Lavender Shirt, Medium Blue Legs');
        $minifig->setQuantity(1);
        $minifig->setBricklinkSRC('https://www.bricklink.com/v2/catalog/catalogitem.page?M=twn385&#T=I');
        $minifig->setImagePath('https://img.bricklink.com/ItemImage/MN/0/twn385.png');
        

        $brick14 = new Brick();
        $brick14->setBrickId('3626cpb1352');
        $brick14->setName('Minifigure, Head Dual Sided Female Black Eyebrows, Freckles, Eyelashes, Nougat Lips, Open Mouth Smile with Top Teeth and Tongue / Sleeping Pattern - Hollow Stud
        ');
        $brick14->setQuantity(1);
        $brick14->setBrickLinkSRC('https://www.bricklink.com/v2/catalog/catalogitem.page?P=3626cpb1352&idColor=3#T=C&C=3');
        $brick14->setImagePath('https://img.bricklink.com/ItemImage/PN/3/3626cpb1352.png');
        $brick14->setColor('Yellow');
        $brick14->setPartType('Minifigure, Head');
        

        $quan = new Quantity();
        $quan2 = new Quantity();
        $quan3 = new Quantity();
        $quan4 = new Quantity();
        $quan5 = new Quantity();
        $quan->setQuantity(1);
        $quan2->setQuantity(1);
        $quan3->setQuantity(1);
        $quan4->setQuantity(1);
        $quan5->setQuantity(1);
        $quan->setBrickID($brick11);
        $quan2->setBrickID($brick12);
        $quan3->setBrickID($brick13);
        $quan4->setBrickID($brick14);
        $quan5->setBrickID($unitBrick);
        $quan->setMinifigureID($minifig); 
        $quan2->setMinifigureID($minifig); 
        $quan3->setMinifigureID($minifig); 
        $quan4->setMinifigureID($minifig); 
        $quan5->setMinifigureID($minifig); 
        $manager->persist($quan);    
        $manager->persist($quan2);    
        $manager->persist($quan3);    
        $manager->persist($quan4);    
        $manager->persist($quan5);    
        $manager->persist($minifig);
        $manager->persist($brick14);

        $brick15 = new Brick();
        $brick15->setBrickId('90386');
        $brick15->setName('Minifigure, Headgear Beret');
        $brick15->setQuantity(1);
        $brick15->setBrickLinkSRC('https://www.bricklink.com/v2/catalog/catalogitem.page?P=90386&idColor=11#T=C&C=11');
        $brick15->setImagePath('https://img.bricklink.com/ItemImage/PN/11/90386.png');
        $brick15->setColor('Black');
        $brick15->setPartType('Minifigure, Headgear');
        $manager->persist($brick15);

        $brick16 = new Brick();
        $brick16->setBrickId('970c00');
        $brick16->setName('Hips and Legs Plain');
        $brick16->setQuantity(1);
        $brick16->setBrickLinkSRC('https://www.bricklink.com/v2/catalog/catalogitem.page?P=970c00&idColor=85#T=I&C=85');
        $brick16->setImagePath('https://img.bricklink.com/ItemImage/PN/85/970c00.png');
        $brick16->setColor('Dark Bluish Gray');
        $brick16->setPartType('Minifigure, Legs');
        $manager->persist($brick16);

        $brick17 = new Brick();
        $brick17->setBrickId('973pb3162c01');
        $brick17->setName('Torso Jacket with Pockets and Nougat Collar over Bright Light Blue Shirt Pattern / Dark Red Arms / Yellow Hands');
        $brick17->setQuantity(1);
        $brick17->setBrickLinkSRC('https://www.bricklink.com/v2/catalog/catalogitem.page?P=973pb3162c01&idColor=59#T=I&C=59');
        $brick17->setImagePath('https://img.bricklink.com/ItemImage/PN/59/973pb3162c01.png');
        $brick17->setColor('Dark Red');
        $brick17->setPartType('Minifigure, Torso Assembly, Decor');
        $manager->persist($brick17);

        $brick18 = new Brick();
        $brick18->setBrickId('3626cpb1911');
        $brick18->setName('Minifigure, Head Dark Tan Eyebrows, Moustache, Dark Tan and Gray Sideburns, Stubble and White Pupils Pattern - Hollow Stud');
        $brick18->setQuantity(1);
        $brick18->setBrickLinkSRC('https://www.bricklink.com/v2/catalog/catalogitem.page?P=3626cpb1911&idColor=3#T=C&C=3');
        $brick18->setImagePath('https://img.bricklink.com/ItemImage/PN/3/3626cpb1911.png');
        $brick18->setColor('Yellow');
        $brick18->setPartType('Minifigure, Head');
        $manager->persist($brick18);

        $minifig2 = new Minifigure();
        $minifig2->setMinifigId('twn424');
        $minifig2->setName('Man, Dark Red Jacket with Bright Light Blue Shirt, Dark Bluish Gray Legs, Black Beret, Moustache and Sideburns (Vintage Taxi Driver)');
        $minifig2->setQuantity(1);
        $minifig2->setBricklinkSRC('https://www.bricklink.com/v2/catalog/catalogitem.page?M=twn424&#T=I');
        $minifig2->setImagePath('https://img.bricklink.com/ItemImage/MN/0/twn424.png');
        $manager->persist($minifig2);

        $quan5 = new Quantity();
        $quan6 = new Quantity();
        $quan7 = new Quantity();
        $quan8 = new Quantity();
        $quan9 = new Quantity();
        $quan5->setQuantity(1);
        $quan6->setQuantity(1);
        $quan7->setQuantity(1);
        $quan8->setQuantity(1);
        $quan9->setQuantity(1);
        $quan5->setBrickID($brick15);
        $quan6->setBrickID($brick16);
        $quan7->setBrickID($brick17);
        $quan8->setBrickID($brick18);
        $quan9->setBrickID($unitBrick2);
        $quan5->setMinifigureID($minifig2); 
        $quan6->setMinifigureID($minifig2); 
        $quan7->setMinifigureID($minifig2); 
        $quan8->setMinifigureID($minifig2); 
        $quan9->setMinifigureID($minifig2); 
        $manager->persist($quan5);    
        $manager->persist($quan6);    
        $manager->persist($quan7);    
        $manager->persist($quan8);
        $manager->persist($quan9);


//------------------------------------------------------------------------------------------------------------------------------------------------------------
        $wish1 = new Wish();
        
        $wish1->setSetId('10300');
        $wish1->setName('Back to the Future Time Machine');
        $wish1->setImagePath('https://promoklocki.pl/media/10300/lego-10300.jpg');
        $wish1->setPromoklockiSRC('https://promoklocki.pl/lego-creator-expert-10300-wehikul-czasu-z-powrotu-do-przyszlosci-p21809');
        $wish1->setEolYear(2024);
        $manager->persist($wish1);

        $wish2 = new Wish();
        $wish2->setSetId('10297');
        $wish2->setName('Boutique Hotel');
        $wish2->setImagePath('https://promoklocki.pl/media/10297/lego-10297.jpg');
        $wish2->setPromoklockiSRC('https://promoklocki.pl/lego-creator-expert-10297-hotel-butikowy-p21570');
        $wish2->setEolYear(2024);
        $manager->persist($wish2);

        $wish3 = new Wish();
        $wish3->setSetId('10304');
        $wish3->setName('Chevrolet Camaro Z28');
        $wish3->setImagePath('https://promoklocki.pl/media/10304/lego-10304.jpg');
        $wish3->setPromoklockiSRC('https://promoklocki.pl/lego-icons-10304-chevrolet-camaro-z28-p21991');
        $wish3->setEolYear(2025);
        $manager->persist($wish3);

        $wish4 = new Wish();
        $wish4->setSetId('10248');
        $wish4->setName('Ferrari F40');
        $wish4->setImagePath('https://promoklocki.pl/media/10248/lego-10248.jpg');
        $wish4->setPromoklockiSRC('https://promoklocki.pl/lego-creator-expert-10248-ferrari-f40-p5288');
        $wish4->setEolYear(2016);
        $manager->persist($wish4);

        $wish5 = new Wish();
        $wish5->setSetId('77942');
        $wish5->setName('Fiat 500');
        $wish5->setImagePath('https://promoklocki.pl/media/77942/lego-77942.jpg');
        $wish5->setPromoklockiSRC('https://promoklocki.pl/lego-creator-expert-77942-fiat-500-p21506');
        $wish5->setEolYear(2021);
        $manager->persist($wish5);

        $wish6 = new Wish();
        $wish6->setSetId('10312');
        $wish6->setName('Klub jazzowy');
        $wish6->setImagePath('https://promoklocki.pl/media/10312/lego-10312.jpg');
        $wish6->setPromoklockiSRC('https://promoklocki.pl/lego-icons-10312-klub-jazzowy-p22044');
        $wish6->setEolYear(2025);
        $manager->persist($wish6);

        $wish7 = new Wish();
        $wish7->setSetId('10317');
        $wish7->setName('Land Rover Classic Defender 90');
        $wish7->setImagePath('https://promoklocki.pl/media/10317/lego-10317.jpg');
        $wish7->setPromoklockiSRC('https://promoklocki.pl/lego-icons-10317-land-rover-classic-defender-90-p22293');
        $wish7->setEolYear(2025);
        $manager->persist($wish7);

        $wish8 = new Wish();
        $wish8->setSetId('10302');
        $wish8->setName('Optimus Prime');
        $wish8->setImagePath('https://promoklocki.pl/media/10302/lego-10302.jpg');
        $wish8->setPromoklockiSRC('https://promoklocki.pl/lego-creator-expert-10302-optimus-prime-p21930');
        $wish8->setEolYear(2024);
        $manager->persist($wish8);

        $wish9 = new Wish();
        $wish9->setSetId('10278');
        $wish9->setName('Posterunek policji');
        $wish9->setImagePath('https://promoklocki.pl/media/10278/lego-10278.jpg');
        $wish9->setPromoklockiSRC('https://promoklocki.pl/lego-creator-expert-10278-posterunek-policji-p21103');
        $wish9->setEolYear(2023);
        $manager->persist($wish9);

        $wish10 = new Wish();
        $wish10->setSetId('76218');
        $wish10->setName('Sanctum Sanctorum');
        $wish10->setImagePath('https://promoklocki.pl/media/76218/lego-76218.jpg');
        $wish10->setPromoklockiSRC('https://promoklocki.pl/lego-marvel-super-heroes-76218-sanctum-sanctorum-p21924');
        $wish10->setEolYear(2023);
        $manager->persist($wish10);

        $wish11 = new Wish();
        $wish11->setSetId('10298');
        $wish11->setName('Vespa 125');
        $wish11->setImagePath('https://promoklocki.pl/media/10298/lego-10298.jpg');
        $wish11->setPromoklockiSRC('https://promoklocki.pl/lego-creator-expert-10298-vespa-125-p21767');
        $wish11->setEolYear(2024);
        $manager->persist($wish11);

//---------------------------------------------------------------------------------------------------------------------------------------------

        $el1 = new MainPageElement();
        $el1->setUrl('https://fanklockow.pl');
        $el1->setName('Fan Klocków');
        $el1->setImagePath('https://i0.wp.com/fanklockow.pl/wp-content/uploads/2021/01/FanKlockow-logo-male.png?w=422&ssl=1');
        $manager->persist($el1);

        $el2 = new MainPageElement();
        $el2->setUrl('https://faniklockow.pl');
        $el2->setName('Fani Klocków');
        $el2->setImagePath('https://faniklockow.pl/wp-content/uploads/2020/10/faniklockow_logo_ex.png');
        $manager->persist($el2);

        $el3 = new MainPageElement();
        $el3->setUrl('https://promoklocki.pl');
        $el3->setName('Promoklocki');
        $el3->setImagePath('https://promoklocki.pl/static/promoklocki.png');
        $manager->persist($el3);


//-----------------------------------------------------------------------------------------------------------------------------------------------------



        $manager->flush();
    }
}
