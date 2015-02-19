<?php

namespace PP5\MovieUniverseBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationFormType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', null, array('label' => 'Imię:'));
        $builder->add('surname', null, array('label' => 'Nazwisko:'));
    }

    public function getParent()
    {
        return 'fos_user_registration';
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'pp5_movie_universe_registration';
    }
}