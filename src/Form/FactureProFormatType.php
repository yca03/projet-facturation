<?php

namespace App\Form;

use App\Entity\Clients;
use App\Entity\DetailFacture;
use App\Entity\FactureProFormat;
use App\Entity\ModePayement;
use App\Form\Facture\DetailFactureType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
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

            // Vérifier si le champ numeroFacturePro est vide
            if (empty($data->getNumeroFacturePro())) {
                $prefixe = "2024/ "; // Préfixe souhaité
                $identifiantUnique = uniqid(); // Identifiant unique généré par PHP

                // Formatage de l'identifiant unique pour qu'il ait toujours la même longueur
                $numeroFacturePro = $prefixe . substr($identifiantUnique, -strlen($prefixe));

                $data->setNumeroFacturePro($numeroFacturePro); // Définir le code de facture généré
            }

            if (empty($data->getReference())) {
                $prefixe = "REF-2024-"; // Préfixe souhaité pour la référence
                $identifiantUnique = uniqid(); // Identifiant unique généré par PHP

                // Formatage de l'identifiant unique pour qu'il ait toujours la même longueur
                $reference = $prefixe . substr($identifiantUnique, -6); // Par exemple, prendre les 6 derniers caractères de l'identifiant unique

                $data->setReference($reference); // Définir la référence générée
            }
        });

// Événement de pré-configuration des données du formulaire
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $data = $event->getData();
            $form = $event->getForm();

            // Vérifier si le champ numeroFacturePro est vide
            if (empty($data->getNumeroFacturePro())) {
                $prefixe = "2024/ "; // Préfixe souhaité
                $identifiantUnique = uniqid(); // Identifiant unique généré par PHP

                // Formatage de l'identifiant unique pour qu'il ait toujours la même longueur
                $numeroFacturePro = $prefixe . substr($identifiantUnique, -5);

                $data->setNumeroFacturePro($numeroFacturePro); // Définir le code de facture généré
            }

            if (empty($data->getReference())) {
                $prefixe = "REF-2024-"; // Préfixe souhaité pour la référence
                $identifiantUnique = uniqid(); // Identifiant unique généré par PHP

                // Formatage de l'identifiant unique pour qu'il ait toujours la même longueur
                $reference = $prefixe . substr($identifiantUnique, -5); // Par exemple, prendre les 5 derniers caractères de l'identifiant unique

                $data->setReference($reference); // Définir la référence générée
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
