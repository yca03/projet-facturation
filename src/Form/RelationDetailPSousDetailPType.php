<?php

namespace App\Form;

use App\Entity\DetailProduit;
use App\Entity\RelationDetailPSousDetailP;
use App\Entity\SousDetailProduit;
use App\Form\SousDetailProduitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RelationDetailPSousDetailPType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateDebut')
            ->add('detailProduits', EntityType::class, [
                'class' => DetailProduit::class,
                'group_by' => function($produit) {
                    $typeProduit = $produit->getProduit()->getTypeProduit();
                    $libelleProduit = $produit->getProduit()->getLibelle();
                    return $typeProduit->getLibelle() . ' - ' . $libelleProduit;
                },
                'placeholder' => 'Sélectionnez le détail produit'
            ])

            ->add('sousDetailProduit', CollectionType::class, [
                'entry_type' => SousDetailProduitType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete'=>true,
                'prototype'=>true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RelationDetailPSousDetailP::class,
        ]);
    }
}
