<?php

namespace App\Form\OffreCommerciale;

use App\Entity\Clients;
use App\Entity\OffreCommerciale\OffreCommerciale;
use App\Entity\TypeProduit;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OffreCommercialeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('typeContrat', ChoiceType::class,[
                'choices' => [
                    'Selectionnez un contrat' => 'Selectionnez un contrat',
                    'LICENCE D\' EXPLOITATION'=> 'LICENCE D\'EXPLOITATION',
                    'ABONNEMENT'=> 'ABONNEMENT'
                ]
            ])
            ->add('dureeOffre', ChoiceType::class, [
                'label' => 'Durée de l\'offre (en mois)',
                'choices' => [
                    '1 mois' => 1,
                    '2 mois' => 2,
                    '3 mois' => 3,
                    '6 mois' => 6,
                    '12 mois' => 12
                ],
                'placeholder'=>'Sélectionnez le mois'
            ])
            ->add('dateDebut', DateType::class, [
                'widget' => 'single_text',
            ])

            ->add('dateFin', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('dureePeriodeTest', ChoiceType::class, [
                'label' => 'Durée de l\'offre (en mois)',
                'choices' => [
                    '1 mois' => 1,
                    '2 mois' => 2,
                    '3 mois' => 3,
                    '6 mois' => 6,
                    '12 mois' => 12
                ],
                'placeholder'=>'Sélectionnez le mois'
            ])
            ->add('clients', EntityType::class, [
                'class' => Clients::class,
                'placeholder'=>'Sélectionnez un client',
            ])
            ->add('typeProduit', EntityType::class, [
                'class' => TypeProduit::class,
                'placeholder'=>'Sélectionnez un Produit',
            ])
            ->add('remise')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => OffreCommerciale::class,
        ]);
    }
}
