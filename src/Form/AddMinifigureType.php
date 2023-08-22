<?php

namespace App\Form;

use App\Entity\Minifigure;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class AddMinifigureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('minifigId',TextType::class,[
                'label' => 'Numer minifigurki: '
                ])
            ->add('name',TextType::class,[
                'label' => 'Nazwa minifigurki: '
                ])
            ->add('quantity',IntegerType::class,[
                'label' => 'Ilość: '
                ])
            ->add('BricklinkSRC')
            ->add('ImagePath')
            ->add('Akceptuj', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Minifigure::class,
        ]);
    }
}
