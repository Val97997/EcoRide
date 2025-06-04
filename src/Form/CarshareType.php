<?php

namespace App\Form;

use App\Entity\Car;
use App\Entity\Carshare;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CarshareType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('departure_date', null, [
                'widget' => 'single_text'
            ])
            ->add('departure_hour', null, [
                'widget' => 'single_text'
            ])
            ->add('departure_location')
            ->add('arrival_date', null, [
                'widget' => 'single_text'
            ])
            ->add('arrival_hour', null, [
                'widget' => 'single_text'
            ])
            ->add('arrival_location')
            ->add('status')
            ->add('available_seats')
            ->add('price')
            ->add('user', EntityType::class, [
                'class' => User::class,
'choice_label' => 'id',
            ])
            ->add('car', EntityType::class, [
                'class' => Car::class,
'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Carshare::class,
        ]);
    }
}
