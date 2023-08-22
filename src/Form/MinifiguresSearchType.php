<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;


class MinifiguresSearchType extends AbstractType
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
                'Sortuj po numerze katalogowym rosnąco' => 'MinifigureId_ASC',
                'Sortuj po numerze katalogowym malejąco' => 'MinifigureId_DESC',
                'Sortuj po nazwie A-Z' => 'name_ASC',
                'Sortuj po nazwie Z-A' => 'name_DESC',
            ],
            'label' => 'Sortowanie: '
        ])
        ->add('save', SubmitType::class, ['label' => 'Szukaj'])
        ->setMethod('GET')
        ->getForm();
    }
}