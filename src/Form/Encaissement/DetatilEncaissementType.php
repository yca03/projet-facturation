<?php

namespace App\Form\Encaissement;

use App\Entity\Encaissement\DetatilEncaissement;
use App\Entity\Facture;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DetatilEncaissementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('solde')

            ->add('MontantDu',  TextType::class, [
                'attr' => ['readonly' => 'readonly'],
            ])
            ->add('montantVerse')
            ->add('facture', EntityType::class, [
                'class' => Facture::class,
                'choice_label' => 'reference',
                'placeholder' => 'Sélectionnez une facture',
//                'required' => false,
            ]);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DetatilEncaissement::class,
        ]);
    }
}
