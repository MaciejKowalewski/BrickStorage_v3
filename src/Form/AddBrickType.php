<?php

namespace App\Form;

use App\Entity\Brick;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class AddBrickType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('BrickId',TextType::class,[
                'label' => 'Numer elementu: '
                ])
            ->add('Name',TextType::class,[
                'label' => 'Nazwa elementu: '
                ])
            ->add('Quantity',IntegerType::class,[
                'label' => 'Ilość: '
                ])
            ->add('BricklinkSRC')
            ->add('ImagePath')
            ->add('Color')
            ->add('PartType')
            ->add('Akceptuj', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Brick::class,
        ]);
    }
}
