<?php

namespace App\Form;

use App\Entity\Files;
use App\Entity\Demandes;
use App\Repository\DemandesRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\PropertyAccess\PropertyPath;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class FilesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if (isset($_GET['d'])) { 
            $builder
                ->add('file', VichFileType::class, [
                    //*sans  VichUploader:
                    //->add('file', FileType::class, [
                    'label' => 'File',
                    'allow_delete' => true,
                    'delete_label' => 'Remove file',
                    //'download_uri' => $router->generateUrl('download_file', $file->getId()),
                    'download_uri' => "/stockage/fichiers/demandes",
                    //'download_label' => 'download_file',
                    'download_label' => new PropertyPath('name'),

                    // unmapped veut dire que ce champ  n'est pas relie  à aucune propriete d une entite 
                    //'mapped' => false,

                    
                    // every time you edit the Product details
                    'required' => true,
                  
                ])
                ->add('type')
                //Note: simple version, without queryBuilder:
                /*->add('demandes', EntityType::class, [
                // query choices from this entity
                'class' => Demandes::class,
                'choice_label' => 'label',
                'label' => 'Demandes',
                'disabled'=>false,
             ])*/
                //Note: complet version with GET
                ->add('demandes', EntityType::class, [
                    'label' => 'Ajouter a la demande:',
                    'class' => Demandes::class,
                    'query_builder' => function (DemandesRepository $er) {
                        return $er
                            ->createQueryBuilder('d')
                            ->andWhere('d.id= :val')
                            ->setParameter('val', $_GET['d']);
                    },
                    'choice_label' => 'label',
                    'choice_value' => 'id',
                    'disabled' => false,
                ]);
        } else {    //* for admin with complet list of documents in the select
            $builder
                ->add('file', VichFileType::class, [
                    'label' => 'File',
                    'allow_delete' => true,
                    'delete_label' => 'Remove file',
                    //'download_uri' => $router->generateUrl('download_file', $file->getId()),
                    // 'download_label' => 'download_file',
                    'download_label' => new PropertyPath('name'),
                    'required' => true,
                ])
                ->add('type')
                ->add('demandes', EntityType::class, [
                    'label' => 'Ajouter a la demande',
                    'class' => Demandes::class,
                    'query_builder' => function (DemandesRepository $er) {
                        return $er
                            ->createQueryBuilder('d')
                            ->orderBy('d.label', 'ASC');
                    },
                    'choice_label' => 'label',
                    'choice_value' => 'id',
                    'disabled' => false,
                ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Files::class,
        ]);
    }
}
