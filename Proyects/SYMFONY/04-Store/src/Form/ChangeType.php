<?php

namespace App\Form;

use App\Entity\Change;
use App\Entity\Product;
use App\Enum\ChangeType as EnumChangeType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class ChangeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date', null, [
                'widget' => 'single_text',
            ])
            ->add('product', EntityType::class, [
                'class' => Product::class,
                'choice_label' => 'description',
            ])
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Input' => EnumChangeType::INPUT,
                    'Output' => EnumChangeType::OUTPUT,
                ],
                'label' => 'Type',
            ])
            ->add('amount')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Change::class,
        ]);
    }
}
