<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Email form. Used to request a password reset.
 */
class EmailForm extends AbstractType
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
            ->add('email', EmailType::class, [
                'constraints' => [
                    new NotBlank()
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
