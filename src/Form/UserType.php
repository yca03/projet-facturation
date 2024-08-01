<?php

namespace App\Form;

use App\Entity\Societe;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('email')
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'SUPER_ADMINISTRATEUR' => 'ROLE_SUPER_ADMIN',
                    'ADMINISTRATEUR /  Créer un utilisateur ' => 'ROLE_ADMIN',
                    'SOCIETE /  Créer une société ' => 'ROLE_SOCIETY',
                    'CLIENT /  Créer un client(s) ' => 'ROLE_CLIENT',
                    'CONSULTATION /  Consulter un état , imprimer une facture '=>'ROLE_CONSULTER',
                    'FACTURE PRO-FORMA /  Créer,supprimer,modifier une facture pro-forma' => 'ROLE_CREATEUR',
                    'FACTURE /  Créer , supprimer , modifier une facture' => 'ROLE_FACTURE',
                    'PRODUIT / Créer , supprimer , modifier un produit'=> 'ROLE_PRODUIT'
                ],
                'multiple' => true,
                'attr' => ['class' => 'select2'],
            ])
            ->add('password')
            ->add('contact')
            ->add('status', CheckboxType::class, [
                'label' => 'Actif',
                'required' => false,
            ])
        ->add('nomUtilisateur');
//        ->add('relation',EntityType::class,[
//             'class'=>Societe::class
//        ]);
            
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
