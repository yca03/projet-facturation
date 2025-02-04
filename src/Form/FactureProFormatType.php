<?php

namespace App\Form;

use App\Entity\Clients;
use App\Entity\DetailFacture;
use App\Entity\Facture;
use App\Entity\FactureProFormat;
use App\Entity\ModePayement;
use App\Form\Facture\DetailFactureType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FactureProFormatType extends AbstractType
{
    private $entityManager;


    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date')
            ->add('periode')
            ->add('periode_2')
            ->add('description')
            ->add('remise',ChoiceType::class,[
                'choices'=> [
                    '5%' => 5,
                    '10%' => 10,
                    '15%' => 15,
                    '20%' => 20,
                    '25%' => 25,
                    '30%' => 30,
                    '35%' => 35,
                    '40%' => 40,
                    '45%' => 45,
                    '50%'=> 50

                ],
                'placeholder'=> 'rémise sur la facture',
                'required' => false,
            ])
            ->add('reference')
            ->add('numeroFacturePro')
            ->add('dateEcheance', null, [
                'widget' => 'single_text',
            ])
            ->add('clients', EntityType::class, [
                'class' => Clients::class,
                'placeholder'=>'Sélectionnez la Client'
            ])
            ->add('modePayement', EntityType::class, [
                'class' => ModePayement::class,
                'placeholder'=>'Sélectionnez un mode de payement'
            ])
            ->add('detailFacture', CollectionType::class, [
                'entry_type' => DetailFactureType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true
            ]);


        $builder
            ->addEventListener(
                FormEvents::POST_SUBMIT,
                function (FormEvent $event) {
                    /** @var DetailFacture $data */
                    $data = $event->getData();
                    $totalHT = 0;
                    $totalTVA = 0;
                    $totalTTC = 0;
                    foreach ($data->getDetailFacture() as $detailFacture) {
                        // Assurez-vous que les méthodes sont appelées avec des parenthèses
                        $totalHT += $detailFacture->getMontantHT();
                        $totalTVA += $detailFacture->getMontantTVA();
                        $totalTTC += $detailFacture->getMontantTTC();
                    }
                    // Mettez à jour les totaux dans l'objet DetailFacture
                    $data->setTotalTTC($totalTTC);
                    $data->setTotalHT($totalHT);
                    $data->setTotalTVA($totalTVA);
                }
            );


// Événement de soumission du formulaire
        $builder->addEventListener(FormEvents::SUBMIT, function (FormEvent $event) {
            $data = $event->getData();
            $form = $event->getForm();

            if (empty($data->getNumeroFacturePro())) {
                $lastFacture = $this->entityManager->getRepository(FactureProFormat::class)
                    ->createQueryBuilder('f')
                    ->orderBy('f.numeroFacturePro', 'DESC')
                    ->setMaxResults(1)
                    ->getQuery()
                    ->getOneOrNullResult();

                if ($lastFacture) {
                    preg_match('/(\d+)$/', $lastFacture->getNumeroFacturePro(), $matches);
                    $lastNumber = isset($matches[1]) ? (int)$matches[1] : 0;
                    $nextNumber = str_pad($lastNumber + 1, 5, '0', STR_PAD_LEFT);

                    $codeFacture = 'N° 2024 Z075 /00' . $nextNumber;
                } else {
                    $codeFacture = 'N° 2024 Z075 /0001';
                }

                $data->SetNumeroFacturePro($codeFacture);
            }

            if (empty($data->getReference())) {
                $prefixe = "REF-2024-";
                $identifiantUnique = uniqid();

                $reference = $prefixe . substr($identifiantUnique, -6);

                $data->setReference($reference);
            }
        });

// Événement de pré-configuration des données du formulaire
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $data = $event->getData();
            $form = $event->getForm();


            if (empty($data->getNumeroFacturePro())) {

                $lastFacture = $this->entityManager->getRepository(FactureProFormat::class)
                    ->createQueryBuilder('f')
                    ->orderBy('f.numeroFacturePro', 'DESC')
                    ->setMaxResults(1)
                    ->getQuery()
                    ->getOneOrNullResult();

                if ($lastFacture) {

                    preg_match('/(\d+)$/', $lastFacture->getNumeroFacturePro(), $matches);
                    $lastNumber = isset($matches[1]) ? (int)$matches[1] : 0;
                    $nextNumber = str_pad($lastNumber + 1, 5, '0', STR_PAD_LEFT);

                    $codeFacture = 'N° 2024 Z075 /00' . $nextNumber;
                } else {
                    $codeFacture = 'N° 2024 Z075 /0001'; // Première facture
                }

                $data->SetNumeroFacturePro($codeFacture);
            }

            if (empty($data->getReference())) {
                $prefixe = "REF-2024-";
                $identifiantUnique = uniqid();

                $reference = $prefixe . substr($identifiantUnique, -5);

                $data->setReference($reference);
            }
        });
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FactureProFormat::class,
        ]);
    }
}
