<?php

namespace App\Form;

use App\Entity\ResetPassword;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;
use Symfony\Component\Validator\Constraints\Regex;

class ResetPasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('oldPassword', PasswordType::class, [
                'label' => 'Ancien mot de passe',
                'required' => true,
                'constraints' => [
                    new Regex([
                        'pattern' => '/^(?=.{8,}$)(?=.*?[a-z])(?=.*?[A-Z])(?=.*?[0-9]).*$/',
                        'message' => 'Votre mot de passe doit faire 8 caractères minimum utilisant majuscule(s), minuscule(s) et chiffre(s).',
                    ]),
                    new UserPassword([
                        'message' => 'Mot de passe actuel incorrect.',
                    ]),
                ],
            ])
            ->add('newPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Les mots de passe ne correspondent pas.',
                'required' => true,
                'options' => [
                    'attr' => [
                        'class' => 'password-field',
                    ],
                ],
                'constraints' => [
                    new Regex([
                        'pattern' => '/^(?=.{8,}$)(?=.*?[a-z])(?=.*?[A-Z])(?=.*?[0-9]).*$/',
                        'message' => 'Votre mot de passe doit faire 8 caractères minimum utilisant majuscule(s), minuscule(s) et chiffre(s).',
                    ]),
                ],
                'first_options' => ['label' => 'Nouveau mot de passe'],
                'second_options' => ['label' => 'Confirmer le nouveau mot de passe'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ResetPassword::class,
        ]);
    }
}
