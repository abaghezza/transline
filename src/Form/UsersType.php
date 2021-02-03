<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;


class UsersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder
            ->add('email', EmailType::class)
            
             ->add('roles', ChoiceType::class, [
                'choices' => [
                    'Utilisateur' => 'ROLE_USER',
                    'Traducteur' => 'ROLE_TRANSLATOR',
                    'Commercial' => 'ROLE_AGENT',
                    'Administrateurr' => 'ROLE_ADMIN',
                    
                ],
                
                'expanded' => false,
                'multiple' => true,
                //'choice_label' => ,
                //'choice_value' => ,
                'label' => 'Rôles',
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'help' => 'Entrer le mot de passe',
                'first_options' => ['label' => 'Password'],
                'second_options' => ['label' => 'Confirm Password'],
            ])
            ->add('firstName', TextType::class)
            ->add('lastName', TextType::class)
            ->add('adress', TextType::class)
            ->add('postcode', NumberType::class)
            ->add('city', TextType::class)           
            ->add('createdAt', DateTimeType::class, [
                'disabled' => true,
                'label' => 'Created (not editable)',
            ])
               ->add('telephone', NumberType::class)
            
        ;
            
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
