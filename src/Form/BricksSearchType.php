<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class BricksPaginator extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('search', TextType::class, [
            'label' => 'Wyszukaj: ',
            'required' => false
            ])
        ->add('sortBy',ChoiceType::class, [
            'choices' =>[
                'Sortuj po numerze katalogowym rosnąco' => 'SetId_ASC',
                'Sortuj po numerze katalogowym malejąco' => 'SetId_DESC',
                'Sortuj po nazwie A-Z' => 'name_ASC',
                'Sortuj po nazwie Z-A' => 'name_DESC',
                'Sortuj po kolorze A-Z' => 'color_ASC',
                'Sortuj po kolorze Z-A' => 'color_DESC',
            ],
            'label' => 'Sortowanie: '
        ])
        ->add('save', SubmitType::class, ['label' => 'Szukaj'])
        ->setMethod('GET')
        ->getForm();
    }
}