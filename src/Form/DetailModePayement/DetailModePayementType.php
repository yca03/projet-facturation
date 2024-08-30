<?php

namespace App\Form\DetailModePayement;

use App\Entity\Banque\BanqueClient\BanqueClient;
use App\Entity\Banque\BanqueOnly\BanqueOnly;
use App\Entity\Facture;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DetailModePayementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('reference')
            ->add('montant')
            ->add('BanqueClient', EntityType::class,[
                'class'=>BanqueClient::class,
                'choice_label' => 'numeroCompteBanque',
                'placeholder' => 'Sélectionnez le numéro',
            ])
            ->add('banque', EntityType::class,[
                'class'=>BanqueOnly::class,
                'choice_label' => 'nom',
                'placeholder' => 'Sélectionnez la banque',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
        ]);
    }
}
