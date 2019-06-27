<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Doctrine\ORM\EntityRepository;

class ActualiteType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('titre')
                ->add('titreEng')
                ->add('extrait')
                ->add('extraitEng')
                ->add('surTitre')
                ->add('surTitreEng')
                ->add('description')
                ->add('descriptionEng')
                ->add('imageFile', FileType::class, array('mapped' => false, 'required' => false))
                ->add('categorieActualites' ,EntityType::class, array(
                    // query choices from this entity
                    'class' => 'AppBundle:CategorieActualite',
                    // use the User.username property as the visible option string
                    'choice_label' => 'libelle',
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('c')
                                /*->where('c.parent is null')*/;
                    },
                    'required' => false,
                    'multiple' => TRUE))
                ->add('chaine' ,EntityType::class, array(
                    // query choices from this entity
                    'class' => 'AppBundle:Chaine',
                    // use the User.username property as the visible option string
                    'choice_label' => 'nom',
                    'required' => false));
    }

/**
     * {@inheritdoc}
     */

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Actualite'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'appbundle_actualite';
    }

}
