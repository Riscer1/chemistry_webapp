<?php

namespace App\Form;

use App\Entity\OscillatorStrength;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\{NumberType, SubmitType, TextType, IntegerType};
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OscillatorStrengthType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('term', TextType::class)
            ->add('transition',TextType::class)
            ->add('jJ', TextType::class)
            ->add('fik1', NumberType::class)
            ->add('aki1', NumberType::class)
            ->add('fik2', NumberType::class)
            ->add('aki2', NumberType::class)
            ->add('fik3', NumberType::class)
            ->add('aki3', NumberType::class)
            ->add('fik4', NumberType::class)
            ->add('aki4', NumberType::class)
            ->add('fik5', NumberType::class)
            ->add('aki5', NumberType::class)
            ->add('save', SubmitType::class)

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => OscillatorStrength::class,
        ]);
    }
}
