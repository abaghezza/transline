<?php

namespace App\Form;

use App\Entity\Langues;
use App\Entity\Users;
use App\Entity\Demandes;
use App\Repository\UsersRepository;
use App\Repository\LanguesRepository;
use Symfony\Component\Form\AbstractType;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class DemandesType extends AbstractType
{
	
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //$editedObject = $builder->getData();
        $builder
            
            ->add('label', TextType::class, [
                'required' => true,
                'label' => ' Type de document (Permis de conduire, contrat de location ...)  (*)'
            ])
            ->add('comment' , TextType::class, [
                'required' => false,
                'label' => 'Un commentaire au traducteur ? (facultatif)'
            ])
            
                
				            ->add('mail' , TextType::class, [
                'required' => false,
                'label' => 'Mail de livraison si different '
            ])
->add('langue', EntityType::class, [
    'class' => Langues::class,
    'query_builder' => function (LanguesRepository $er) {
        return $er->createQueryBuilder('l')
            ->orderBy('l.combination', 'ASC');
    },
    'choice_label' => 'combination',
]);
             }
    

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Demandes::class,
        ]);
    }
}
