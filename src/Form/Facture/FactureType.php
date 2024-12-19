<?php

namespace App\Form\Facture;

use App\Entity\Clients;
use App\Entity\DetailFacture;
use App\Entity\Facture;
use App\Entity\ModePayement;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityManagerInterface;

class FactureType extends AbstractType
{

    private $entityManager;


    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('modePayement' , EntityType::class,
            [
                'class'=> ModePayement::class,
                'placeholder'=>'Sélectionnez le Mode de payement'
            ])
            ->add('codeFacture')
            ->add('description')
            ->add('remise')
            ->add('date', dateType::class, [
                'widget' => 'single_text',
                'data' => new \DateTime(),
                'html5' => false,
                'format' => 'dd-MM-yyyy HH:mm',
            ])
            ->add('IdClient', EntityType::class, [
                'class' => Clients::class,
                'placeholder'=>'Sélectionnez un Client'
            ])
//            ->add('libelle', TextType::class)
            ->add('detailFactures', CollectionType::class, [
                'entry_type' => DetailFactureType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete'=>true,
                'prototype'=>true
            ])
//            ->add('reference',HiddenType::class,[])
            ->add('reference')
            ->add('dateExpiration');

        ;

        $builder
            ->addEventListener(
                FormEvents::POST_SUBMIT,
                function (FormEvent $event) {
                    /** @var DetailFacture $data */
                    $data = $event->getData();
                    $totalHT = 0;
                    $totalTVA = 0;
                    $totalTTC = 0;
                    foreach ($data->getDetailFactures() as $detailFactures) {
                        // Assurez-vous que les méthodes sont appelées avec des parenthèses
                        $totalHT += $detailFactures->getMontantHT();
                        $totalTVA += $detailFactures->getMontantTVA();
                        $totalTTC += $detailFactures->getMontantTTC();
                    }
                    // Mettez à jour les totaux dans l'objet DetailFacture
                    $data->setTotalTTC($totalTTC);
                    $data->setTotalHT($totalHT);
                    $data->setTotalTVA($totalTVA);
                }
            );


        // Event Listener for PRE_SET_DATA (Before the form is displayed)
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $data = $event->getData();
            $form = $event->getForm();


            if (empty($data->getCodeFacture())) {

                $lastFacture = $this->entityManager->getRepository(Facture::class)
                    ->createQueryBuilder('f')
                    ->orderBy('f.codeFacture', 'DESC')
                    ->setMaxResults(1)
                    ->getQuery()
                    ->getOneOrNullResult();

                if ($lastFacture) {

                    preg_match('/(\d+)$/', $lastFacture->getCodeFacture(), $matches);
                    $lastNumber = isset($matches[1]) ? (int)$matches[1] : 0;
                    $nextNumber = str_pad($lastNumber + 1, 5, '0', STR_PAD_LEFT);

                    $codeFacture = 'N° 2024 Z075 /00' . $nextNumber;
                } else {
                    $codeFacture = 'N° 2024 Z075 /0001';
                }

                $data->setCodeFacture($codeFacture);
            }

            // Vérifier et générer la référence si elle est vide
            if (empty($data->getReference())) {
                $prefixe = "REF-2024-";
                $identifiantUnique = uniqid();


                $reference = $prefixe . substr($identifiantUnique, -6);

                $data->setReference($reference);
            }
        });

        // Event Listener for SUBMIT (After the form is submitted)
        $builder->addEventListener(FormEvents::SUBMIT, function (FormEvent $event) {
            $data = $event->getData();
            $form = $event->getForm();


            if (empty($data->getCodeFacture())) {
                // Récupérer la dernière facture insérée pour déterminer l'incrément
                $lastFacture = $this->entityManager->getRepository(Facture::class)
                    ->createQueryBuilder('f')
                    ->orderBy('f.codeFacture', 'DESC')
                    ->setMaxResults(1)
                    ->getQuery()
                    ->getOneOrNullResult();

                if ($lastFacture) {

                    preg_match('/(\d+)$/', $lastFacture->getCodeFacture(), $matches);
                    $lastNumber = isset($matches[1]) ? (int)$matches[1] : 0;
                    $nextNumber = str_pad($lastNumber + 1, 7, '0', STR_PAD_LEFT);

                    $codeFacture = 'N° 2024 Z075 /00' . $nextNumber;
                } else {
                    $codeFacture = 'N° 2024 Z075 /0001';
                }

                $data->setCodeFacture($codeFacture);
            }

            // Vérifier et générer la référence si elle est vide après la soumission
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
            'data_class' => Facture::class,
        ]);
    }
}
