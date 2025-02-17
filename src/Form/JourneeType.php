<?php

namespace App\Form;

use App\Entity\Journee;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JourneeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('periode', null, [
                'widget' => 'single_text',
            ])
            ->add('enable', CheckboxType::class, [
                'label' => 'Activé ?',
                'label_attr' => [
                    'class' => 'custom-control-label'
                ],
                'attr' => [
                    'class' => 'custom-control-input',
                    'id' => 'customSwitch1'
                ],
                'required' => false,
            ])
//            ->add('createdAdt', null, [
//                'widget' => 'single_text',
//            ])
//            ->add('endedAt', null, [
//                'widget' => 'single_text',
//            ])
       ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Journee::class,
        ]);
    }
}
