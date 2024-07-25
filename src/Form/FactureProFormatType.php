<?php

namespace App\Form;

use App\Entity\Clients;
use App\Entity\FactureProFormat;
use App\Entity\ModePayement;
use App\Form\Facture\DetailFactureType;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FactureProFormatType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date', dateType::class, [
                'widget' => 'single_text',
                'data' => new \DateTime(),
            ])
            ->add('reference')
            ->add('numeroFacturePro')
            ->add('dateEcheance', null, [
                'widget' => 'single_text',
            ])
            ->add('clients', EntityType::class, [
                'class' => Clients::class,
            ])
            ->add('modePayement', EntityType::class, [
                'class' => ModePayement::class,
            ])
            ->add('detailFacture', CollectionType::class, [
                'entry_type' => DetailFactureType::class,
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
            'data_class' => FactureProFormat::class,
        ]);
    }
}
