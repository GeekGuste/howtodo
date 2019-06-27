<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class CategorieActualiteType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('libelle')
                ->add('libelleEng')
                ->add('imageFile', FileType::class, array('mapped' => false, 'required' => false))
                ->add('parent', EntityType::class, array(
                    'class' => 'AppBundle:CategorieActualite',
                    'choice_label' => 'libelle',
                    'required' => false,
                ))
                ->add('description');
    }

/**
     * {@inheritdoc}
     */

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\CategorieActualite'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'appbundle_categorieactualite';
    }

}
