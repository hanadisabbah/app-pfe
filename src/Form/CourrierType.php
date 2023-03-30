<?php

namespace App\Form;

use App\Entity\Courrier;
use App\Entity\Livreur;
use App\Entity\User;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CourrierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('barcode', null, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            
            ->add('typeCourrier', ChoiceType::class, [
                'label' => 'Choisir le type de courrier',
                'choices' => [
                    'Simple' => 'Simple',
                    'Grande' => 'Grande',
                    'Multiple' => 'Multiple'
                ]
                ,  'attr'  => [
                    'class' => 'form-control'
                ]
            ])
            /*->add('status', ChoiceType::class, [
                'choices' => [
                    'En Cours' => 'onloading',
                    'En Stock' => 'onstock',
                    'Arrivé'   => 'arrived'
                ],
                'attr' => [
                    'class' => 'form-control'
                ]
            ])*/
            //     ->add('createdAt', DateType::class,  [
            //       'widget' => 'single_text',
            //     'attr' => [
            //       'class' => 'form-control'
            // ]
            //  ])
            ->add('deliveryDate', DateType::class,  [
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('startingPost', null, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])

            ->add('arrivalPost', null, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('postalSituation', null, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('deliverySituation', null, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('description', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])


            // ->add('startingPost', null, [
            //   'attr' => [
            //   'class' => 'form-control'
            //          ]
            //    ])
            
            ->add('deliveryMan', EntityType::class, [
                'class' => Livreur::class,
                'attr' => [
                    'class' => 'form-control'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Courrier::class,
        ]);
    }
}
