<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class SearchType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'autocomplete', ['class' => 'AppBundle:Person'])
            ->add('search', 'submit')
        ;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_search';
    }
}