<?php

namespace App\Form;

use App\Entity\RelationDetailPSousDetailP;
use App\Entity\SousDetailProduit;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SousDetailProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('libelle')
//            ->add('dateDebut', null, [
//                'widget' => 'single_text',
//            ])
//            ->add('relationDetailPSousDetailP', EntityType::class, [
//                'class' => RelationDetailPSousDetailP::class,
//                'choice_label' => 'id',
//            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SousDetailProduit::class,
        ]);
    }
}
