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

class FactureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('modePayement' , EntityType::class,
            [
                'class'=> ModePayement::class,
                'placeholder'=>'Sélectionnez le Mode de payement'
            ])
            ->add('codeFacture')
            ->add('date', dateType::class, [
                'widget' => 'single_text',
                 'data' => new \DateTime(),
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


        // Écouteur d'événement pour générer le code de facture automatiquement avant la soumission du formulaire
$builder->addEventListener(FormEvents::SUBMIT, function (FormEvent $event) {
    $data = $event->getData();
    $form = $event->getForm();

    // Vérifier si le champ codeFacture est vide
    if (empty($data->getCodeFacture())) {
        $prefixe = "N 21 Z0075/ "; // Préfixe souhaité
        $identifiantUnique = uniqid(); // Identifiant unique généré par PHP

        // Formatage de l'identifiant unique pour qu'il ait toujours la même longueur
        $codeFacture = $prefixe . substr($identifiantUnique, -strlen($prefixe));

        $data->setCodeFacture($codeFacture); // Définir le code de facture généré
    }

    if (empty($data->getReference())) {
        $prefixe = "REF-2024-"; // Préfixe souhaité pour la référence
        $identifiantUnique = uniqid(); // Identifiant unique généré par PHP

        // Formatage de l'identifiant unique pour qu'il ait toujours la même longueur
        $reference = $prefixe . substr($identifiantUnique, -6); // Par exemple, prendre les 6 derniers caractères de l'identifiant unique

        $data->setReference($reference); // Définir la référence générée
    }
});
$builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event)
{
    $data = $event->getData();
    $form = $event->getForm();

    // Vérifier si le champ codeFacture est vide
    if (empty($data->getCodeFacture())) {
        $prefixe = "N 21 Z0075/ "; // Préfixe souhaité
        $identifiantUnique = uniqid(); // Identifiant unique généré par PHP

        // Formatage de l'identifiant unique pour qu'il ait toujours la même longueur
        $codeFacture = $prefixe . substr($identifiantUnique, -strlen($prefixe));

        $data->setCodeFacture($codeFacture); // Définir le code de facture généré
    }


    if (empty($data->getReference())) {
        $prefixe = "REF-2024-"; // Préfixe souhaité pour la référence
        $identifiantUnique = uniqid(); // Identifiant unique généré par PHP

        // Formatage de l'identifiant unique pour qu'il ait toujours la même longueur
        $reference = $prefixe . substr($identifiantUnique, -6); // Par exemple, prendre les 6 derniers caractères de l'identifiant unique

        $data->setReference($reference); // Définir la référence générée
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
