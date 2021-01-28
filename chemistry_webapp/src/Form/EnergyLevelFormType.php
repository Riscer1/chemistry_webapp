<?php

namespace App\Form;

use App\Entity\EnergyLevel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\{NumberType, SubmitType, IntegerType, TextType};
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EnergyLevelFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('configuration', TextType::class)
            ->add('term', TextType::class)
            ->add('j', IntegerType::class)
            ->add('level', NumberType::class)
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => EnergyLevel::class,
        ]);
    }
}
