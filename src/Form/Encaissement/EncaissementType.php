<?php

namespace App\Form\Encaissement;

use App\Entity\Client;
use App\Entity\Clients;
use App\Entity\Encaissement\Encaissement;
use App\Entity\Facture;
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
use Doctrine\ORM\EntityManagerInterface;

class EncaissementType extends AbstractType
{
    private $entityManager;


    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date', dateType::class, [
                'widget' => 'single_text',
                'data' => new \DateTime(),
            ])
            ->add('clients', EntityType::class, [
                'class' => Clients::class,
                'placeholder'=> 'Sélectionnez un client',
            ])
            ->add('reference')
            ->add('modePayement', EntityType::class, [
                'class' => ModePayement::class,
                'placeholder'=> 'Sélectionnez un Mode de payement',
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
                $currentYear = date('Y'); // Année actuelle
                // Récupérer la dernière référence pour l'année en cours
                $lastReference =$this->entityManager->getRepository(Encaissement::class)
                    ->createQueryBuilder('f')
                    ->orderBy('f.reference', 'DESC')
                    ->setMaxResults(1)
                    ->getQuery()
                    ->getOneOrNullResult();

                if ($lastReference) {
                    // Extraire le dernier numéro de facture et incrémenter
                    preg_match('/(\d+)$/', $lastReference->getReference(), $matches);
                    $lastNumber = isset($matches[1]) ? (int)$matches[1] : 0;
                    $nextNumber = str_pad($lastNumber + 1, 5, '0', STR_PAD_LEFT);
                    // Générer le code facture avec l'année actuelle
                    $reference = 'REF- ' . date('Y') . '2025' . $nextNumber;
                } else {
                    // Première facture de l'année
                    $reference = 'REF- ' . date('Y') . '00001';
                }

                $data->setReference($reference);
            }
        });
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event)
        {
            $data = $event->getData();
            $form = $event->getForm();
            if (empty($data->getReference())) {
                $currentYear = date('Y'); // Année actuelle
                // Récupérer la dernière référence pour l'année en cours
                $lastReference =$this->entityManager->getRepository(Encaissement::class)
                    ->createQueryBuilder('f')
                    ->orderBy('f.reference', 'DESC')
                    ->setMaxResults(1)
                    ->getQuery()
                    ->getOneOrNullResult();

                if ($lastReference) {
                    // Extraire le dernier numéro de facture et incrémenter
                    preg_match('/(\d+)$/', $lastReference->getReference(), $matches);
                    $lastNumber = isset($matches[1]) ? (int)$matches[1] : 0;
                    $nextNumber = str_pad($lastNumber + 1, 5, '0', STR_PAD_LEFT);
                    // Générer le code facture avec l'année actuelle
                    $reference = 'REF- ' . date('Y') . '-' . $nextNumber;
                } else {
                    // Première facture de l'année
                    $reference = 'REF- ' . date('Y') . '00001';
                }

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
