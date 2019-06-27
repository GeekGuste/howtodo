<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;

class ChaineType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom')
                ->add('nomEng')
                ->add('description')
                ->add('descriptionEng')
                ->add('categorieChaines',EntityType::class, array(
                    // query choices from this entity
                    'class' => 'AppBundle:CategorieChaine',
                    // use the User.username property as the visible option string
                    'choice_label' => 'nom',
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('c')
                                ;
                    },
                    'required' => false,
                    'multiple' => TRUE))
                ->add('niveauChaine' ,EntityType::class, array(
                    // query choices from this entity
                    'class' => 'AppBundle:NiveauChaine',
                    'choice_label' => 'libelle',
                    'required' => false))
                ->add('imageFile', FileType::class, array('mapped' => false, 'required' => false));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Chaine'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_chaine';
    }


}
