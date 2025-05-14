<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\FileValidator;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('pseudo', TextType::class, [
                'attr' => ['placeholder' => 'The pseudonym that will be displayed'],
            ])
            ->add('email', EmailType::class, [
                'attr' => ['placeholder' => 'test@mail.com'],
            ])
            ->add('phone_nb', TextType::class, [
                'required' => false,
                'attr' => ['placeholder' => 'Your personal number'],
            ])
            ->add('first_name', TextType::class, [
                'required' => false,
                'attr' => ['placeholder' => 'John'],
            ])
            ->add('last_name', TextType::class, [
                'required' => false,
                'attr' => ['placeholder' => 'Doe'],
            ])
            ->add('address', TextType::class, [
                'required' => false,
                'attr' => ['placeholder' => 'Your address'],
            ])
            ->add('birth_date', DateType::class, [
                'required' => false,
                'attr' => ['placeholder' => 'Your date of birth'],
            ])
            ->add('picture', FileType::class, [
                'required' => false,
                'empty_data' => 'Choose a picture',
                'attr' => ['accept' => '.png,.jpg,.jpeg', 'placeholder' => 'Choose a profile picture'],
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'extensions' => ['png', 'jpg', 'jpeg'],
                        'extensionsMessage' => 'Please upload a valid image (max 1024ko) '
                    ])
                ]
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                
                                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password', 'placeholder' => 'Min 8 char long, 1 Maj, 1 number, 1 special char'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 8,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('confirmPw',PasswordType::class, [
                'mapped' => false,
                'attr' => ['placeholder' => 're-enter password to confirm'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
