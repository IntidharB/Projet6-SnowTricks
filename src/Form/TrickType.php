<?php

namespace App\Form;

use App\Entity\Trick;
use phpDocumentor\Reflection\DocBlock\Description;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TrickType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name' , TextType::class, [
                'attr' =>[
                    'class' =>'form-control mt-2 mb-3'
                ],
                'label' => 'Nom'
            ])
            ->add('description' , TextareaType::class, [
                'attr' =>[
                    'class' =>'form-control mt-2 mb-3'
                ],
                'label' => 'Description'

            ])
            ->add('submit', SubmitType::class, [
                'attr' =>[
                    'class' => 'btn btn-primary mt-2 mb-3'
                ],
                'label' => 'Ajouter'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Trick::class,
        ]);
    }
}
