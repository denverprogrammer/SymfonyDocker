<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\DTO\RegisterUser;

/**
 * Create password form.  Used to set a user password.
 */
class PasswordForm extends AbstractType
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
