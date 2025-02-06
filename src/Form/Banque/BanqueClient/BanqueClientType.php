<?php

namespace App\Form\Banque\BanqueClient;

use App\Entity\Banque\BanqueClient\BanqueClient;
use App\Entity\Banque\BanqueOnly\BanqueOnly;
use App\Entity\Clients;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BanqueClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
//            ->add('uid')
            ->add('numeroCompteBanque')
            ->add('rib')
            ->add('codeAgent')
            ->add('numeroBic')
            ->add('gestionnaire')
            ->add('banqueOnly', EntityType::class, [
                'class' => BanqueOnly::class,
                'choice_label' => 'nom',
                'placeholder'=>'selectionnez une banque'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => BanqueClient::class,
        ]);
    }
}
