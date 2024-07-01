<?php

namespace App\Form;

use App\Entity\Societe;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SocieteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('RaisonSocial')
            ->add('Forme')
            ->add('Activite')
            ->add('Numero')
            ->add('Siege')
            ->add('Telephone')
            ->add('ville')
//            ->add('relation', EntityType::class, [
//                'class' => User::class,
//                'choice_label' => 'id',
//            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Societe::class,
        ]);
    }
}
