<?php

namespace App\Form\DetailModePayement;

use App\Entity\Facture;
use Symfony\Component\Form\AbstractType;
use App\Entity\Banque\BanqueOnly\BanqueOnly;
use App\Entity\Banque\BanqueClient\BanqueClient;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\DetailModePyement\DetailModePayement;
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
                'required'=>false,
                'placeholder' => 'Sélectionnez le numéro',
            ])
            ->add('banque', EntityType::class,[
                'class'=>BanqueOnly::class,
                'choice_label' => 'nom',
                'required'=>false,
                'placeholder' => 'Sélectionnez la banque',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DetailModePayement::class, // Assurez-vous que cette classe est correcte
        ]);
    }
}
