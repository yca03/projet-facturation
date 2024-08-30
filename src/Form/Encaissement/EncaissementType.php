<?php

namespace App\Form\Encaissement;

use App\Entity\Client;
use App\Entity\Clients;
use App\Entity\Encaissement\Encaissement;
use App\Entity\ModePayement;
use App\Form\DetailModePayement\DetailModePayementType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EncaissementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date', dateType::class, [
                'widget' => 'single_text',
                'data' => new \DateTime(),
            ])
            ->add('clients', EntityType::class, [
                'class' => Clients::class,
                'placeholder'=> 'Sélectonnez un client',
            ])
            ->add('reference')
            ->add('modePayement', EntityType::class, [
                'class' => ModePayement::class,
                'placeholder'=> 'Sélectonnez un Mode de payement',
            ])
            ->add('detatilEncaissements', CollectionType::class, [
                'entry_type' => DetatilEncaissementType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete'=>true,
                'prototype'=>true
            ])

            ->add('detailModePayements', CollectionType::class, [
                'entry_type' => DetailModePayementType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete'=>true,
                'prototype'=>true
            ])
        ;
        $builder->addEventListener(FormEvents::SUBMIT, function (FormEvent $event) {
            $data = $event->getData();
            $form = $event->getForm();

            if (empty($data->getReference())) {
                $prefixe = "REF-2024-";
                $identifiantUnique = uniqid();
                $reference = $prefixe . substr($identifiantUnique, -6);
                $data->setReference($reference);
            }
        });
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event)
        {
            $data = $event->getData();
            $form = $event->getForm();
            if (empty($data->getReference())) {
                $prefixe = "REF-2024-";
                $identifiantUnique = uniqid();
                $reference = $prefixe . substr($identifiantUnique, -6);
                $data->setReference($reference);
            }
        });
    }





    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Encaissement::class,
        ]);
    }

}
