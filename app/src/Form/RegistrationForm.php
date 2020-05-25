<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\DTO\RegisterUser;

/**
 * Register user form
 */
class RegistrationForm extends AbstractType
{
    /**
     * Builds form.
     *
     * @param FormBuilderInterface $builder Form builder.
     * @param array                $options Form options.
     *
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class)
            ->add('lastName', TextType::class)
            ->add('email', EmailType::class, [
                'constraints' => [
                    new NotBlank()
                ]
            ])
            ->add('password', PasswordType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Length([
                        'min'        => 5,
                        'minMessage' => 'Password must be at least 5 characters.'
                    ])
                ]
            ])
        ;
    }

    /**
     * Form configuration.
     *
     * @param OptionsResolver $resolver Form configuration.
     *
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'      => RegisterUser::class,
            'csrf_protection' => false
        ]);
    }

    /**
     * Gets name of form.
     *
     * @return string|null
     */
    public function getBlockPrefix()
    {
        return null;
    }
}
