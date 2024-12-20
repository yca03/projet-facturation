<?php

namespace App\Form\Facture;

use App\Entity\DetailFacture;
use App\Entity\Produit;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DetailFactureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('periode')
            ->add('quantite')
            ->add('prix')
            ->add('montantTTC')
            ->add('montantHT')
            ->add('montantTVA')
            ->add('remise')
            ->add('montantBrut')
            ->add('produit', EntityType::class, [
                'class' => Produit::class,
                'group_by' => function($typeProduit) {
                    return $typeProduit->getTypeProduit()->getLibelle();
                },
                'attr' => ['class' => 'select2'],
                'placeholder' => 'Sélectionnez un service',

            ]);
           
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DetailFacture::class,
        ]);
    }
}
