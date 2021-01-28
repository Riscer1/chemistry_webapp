<?php

namespace App\Form;

use App\Entity\Atom;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\{FileType, IntegerType, NumberType, SubmitType, TextType};
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;

class AtomType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('symbol', TextType::class)
            ->add('name', TextType::class)
            ->add('atomicNumber', IntegerType::class)
            ->add('atomicWeight', NumberType::class)
            ->add('atomicRadius', IntegerType::class)
            ->add('ionRadius', IntegerType::class)
            ->add('meltingTemperature', NumberType::class)
            ->add('density', NumberType::class)
            ->add('boilingTemperature', NumberType::class)
            ->add('image', FileType::class,[
                'label' => 'Photo (png, jpeg)',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new Image()
                ]
            ])
            ->add('save', SubmitType::class, ['label' => 'Save'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Atom::class,
        ]);
    }
}
