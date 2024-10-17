<?php

namespace App\Form;

use App\Entity\Facture;
use App\Entity\FactureProFormat;
use App\Entity\Notify;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NotifyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('uid')
            ->add('message')
            ->add('link')
            ->add('statut')
            ->add('dateDebut', null, [
                'widget' => 'single_text',
            ])
            ->add('dateFin', null, [
                'widget' => 'single_text',
            ])
            ->add('Facture', EntityType::class, [
                'class' => Facture::class,
                'choice_label' => 'id',
            ])
            ->add('FactureProFormat', EntityType::class, [
                'class' => FactureProFormat::class,
                'choice_label' => 'id',
            ])
            ->add('utilisateur', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Notify::class,
        ]);
    }
}
