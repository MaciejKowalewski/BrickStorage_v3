<?php

namespace App\Form;

use App\Entity\Wish;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddWishType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('SetId',TextType::class,[
                'label' => 'Numer katalogowy: '
                ])
            ->add('Name',TextType::class,[
                'label' => 'Nazwa zestawu: '
                ])
            ->add('ImagePath',TextType::class,[
                'label' => 'Obrazek: '
                ])
            ->add('PromoklockiSRC',TextType::class,[
                'label' => 'Promoklocki: '
                ])
            ->add('EolYear',IntegerType::class,[
                'label' => 'Rok wycofania: '
                ])
            ->add('Akceptuj', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Wish::class,
        ]);
    }
}
