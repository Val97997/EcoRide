<?php

namespace App\Form;

use App\Document\Review;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReviewType extends AbstractType{
    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder
            ->add('created_at', DateTimeType::class, [
                'label' => false,
                'data' => date('Y/m/d-H:i'),
            ])
            ->add('content', TextType::class, [
                'label' => 'commentary',
                'attr' => ['rows' => 5],
            ])
            ->add('rating', null)
            ->add('save', SubmitType::class, [
                'label' => 'Submit review',
                'attr' => ['class' => 'btn btn-dark']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver){
        $resolver->setDefaults([
            'data_class' => Review::class,
        ]);
    }
}