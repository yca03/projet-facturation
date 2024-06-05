<?php

namespace App\Form;

use App\Entity\Produit;
use App\Entity\TypeProduit;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libelle')
            ->add('uid', HiddenType::class)
            ->add('updateDate', DateType::class, [
                'widget' => 'single_text',
                'data' => new \DateTime(),
            ])
            ->add('prix')
            ->add('typeProduit', EntityType::class, [
                'class' => TypeProduit::class,
            ])
            ->add('tva');


        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $produit = $event->getData();
            $form = $event->getForm();

            // Vérifier si le champ uid est vide
            if (empty($produit->getUid())) {
                // Générer un identifiant unique
                $uid = uniqid();

                // Définir l'identifiant unique dans le champ uid
                $produit->setUid($uid);
            }
        });
    }






    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
