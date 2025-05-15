<?php

namespace App\Form;

use App\Entity\Car;
use App\Entity\Carshare;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('departure_date', DateType::class, [
                'label' => false,
                'widget' => 'single_text',
                'attr' => ['placeholder' => 'Date'],
            ])
            ->add('departure_location', null,[
                'label' => false,
                'attr' => ['placeholder' => 'From...'],
            ])
            ->add('arrival_location', null, [
                'label' => false,
                'attr' => ['placeholder' => 'To...'],
            ])
        ;
    }

    // utilisation d'une méthode GET qui permettra de passer les paramètres dans l'url
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Carshare::class,
            'method' => 'GET',
            'crsf_protection' => false,
        ]);
    }

    // la méthode getBlockPrefix() qui permet de retirer le préfixe afin d'avoir des paramètres les plus simple possible
    public function getBlockPrefix()
    {
        return '';
    }
}
