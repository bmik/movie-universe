<?php

namespace PP5\MovieUniverseBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ReviewType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('reviewContent', 'textarea', array('label' => 'Treść recenzji'));
    }

    public function getName()
    {
        return 'review';
    }
	
	public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PP5\MovieUniverseBundle\Entity\Movie\Review',
        ));
    }
	
}