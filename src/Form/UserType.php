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

        $roles = [
          
            'CONSULTATION / Consulter un état , imprimer une facture ' => 'ROLE_CONSULTER',
            'FACTURE PRO-FORMA / Créer , supprimer , modifier une facture pro-forma' => 'ROLE_FACTURE_PRO',
            'FACTURE PRO-FORMA / valider , annuler   une facture pro-forma'=>'ROLE_USER_VALIDED_FACTURE_PRO',
            'FACTURE / Créer , supprimer , modifier une facture' => 'ROLE_FACTURE',
            'FACTURE / valider , anunler  une facture '=>'ROLE_USER_VALIDED_FACTURE',
            'ADMINISTRATEUR / Créer un utilisateur ' => 'ROLE_ADMIN',
        ];

        if (in_array('ROLE_SUPER_ADMIN', $options['current_user_roles'])) {
            $roles = array_filter($roles, function($role) {
                return $role === 'ROLE_ADMIN';
            });
        }
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('email')
            ->add('roles', ChoiceType::class, [
                'choices' => $roles,
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
            'current_user_roles' => [], // ajouter cette option
        ]);
    }
}
