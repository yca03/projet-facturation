<?php

namespace App\Form;

use App\Entity\Societe;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class UserType extends AbstractType
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $roles = [
            'ADMINISTRATEUR / Créer un utilisateur ' => 'ROLE_ADMIN',
            'CONSULTATION / Consulter les états , imprimer des factures ' => 'ROLE_CONSULTER',
            'FACTURE PRO-FORMA / Créer , supprimer , modifier une facture pro-forma' => 'ROLE_FACTURE_PRO',
            'FACTURE PRO-FORMA / valider , annuler   une facture pro-forma'=>'ROLE_VALIDED_FACTURE_PRO',
            'FACTURE / Créer , supprimer , modifier une facture' => 'ROLE_FACTURE',
            'FACTURE / Valider , Anunler , Encaisser une facture '=>'ROLE_VALIDED_FACTURE',

        ];


        // Filtrage des rôles en fonction du rôle de l'utilisateur connecté
        if ($this->security->isGranted('ROLE_SUPER_ADMIN')) {

            $roles = array_filter($roles, function($role) {
                return $role === 'ROLE_ADMIN';
            });
        } elseif ($this->security->isGranted('ROLE_ADMIN')) {

            $roles = array_filter($roles, function($role) {
                return $role !== 'ROLE_ADMIN';
            });
        }
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('email')
            ->add('contact')
            ->add('status', CheckboxType::class, [
                'label' => 'Actif',
                'required' => false,
            ])
            ->add('nomUtilisateur');



        // Ajouter le champ roles seulement si ce n'est pas l'édition de soi-même
        if (!$options['is_editing_self']) {
            if ($this->security->isGranted('ROLE_ADMIN') or $this->security->isGranted('ROLE_SUPER_ADMIN')) {
                $builder->add('roles', ChoiceType::class, [
                    'choices' => $roles,
                    'multiple' => true,
                    'attr' => ['class' => 'select2'],

                ]);
            }
        }
//            ->add('roles', ChoiceType::class, [
//                'choices' => $roles,
//                'multiple' => true,
//                'attr' => ['class' => 'select2'],
//            ])
//            ->add('password')
//        ->add('relation',EntityType::class,[
//             'class'=>Societe::class
//        ]);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'current_user_roles' => [], // ajouter cette option
            'is_editing_self' => false,  // Ajoutez une option pour indiquer si l'utilisateur édite son propre profil
        ]);
    }
}
