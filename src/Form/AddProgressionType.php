<?php

namespace App\Form;

use App\Entity\Progression;
use App\Entity\Type;
use App\Entity\User;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Security;

class AddProgressionType extends AbstractType
{
    public function __construct(private readonly Security $security)
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type', EntityType::class, [
                'class' => Type::class,
                'query_builder' => function (EntityRepository $er) use ($options) {
                    return $er->createQueryBuilder('type')
                        ->where('type.id = :typeId')
                        ->setParameter(':typeId', $options['typeId']);
                },
                'choice_label' => function ($c) {
                    return $c->getId();
                },
            ])
            ->add('user', EntityType::class, [
                'class' => User::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('user')
                        ->where('user.id = :uId')
                        ->setParameter(':uId', $this->security->getUser()->getId());
                },
                'choice_label' => function ($c) {
                    return $c->getId();
                },
            ])
            ->add('complete', IntegerType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Progression::class,
            'typeId' => null,
        ]);
    }
}
