<?php
//Form to set an estimate //

namespace App\Form;

use App\Entity\Demandes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class AcceptEstimateType extends AbstractType
{
        public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('response',ChoiceType::class,array(
                'choices'  => array(
                    'accepter le devis' => 1,
                    'refuser le devis' => 0,                   
                ),
                'expanded' => true,
                'multiple' => false,
				'label' => 'Votre choix'
            ));
			
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Demandes::class,
        ]);
    }
}
