<?php

namespace App\Form;

use App\Entity\Clients;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClientsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('typeSociete', ChoiceType::class, [
                'choices' => [
                    'Entreprise Individuelle (EI)' => 'EI',
                    'Société Anonyme (SA)' => 'SA',
                    'Société à Responsabilité Limitée (SARL)' => 'SARL',
                    'Société à Responsabilité Limitée Unipersonnelle (SARLU)' => 'SARLU',

                ],
                'placeholder' => 'Sélectionner un type de société',
            ])
            ->add('nom')
            ->add('adresse')
            ->add('contact')
            ->add('numeroCompteContribuable')
            ->add('remise',TextType::class,[
                'required'=>false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Clients::class,
        ]);
    }
}
