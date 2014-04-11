<?php
/**
 * Created by IntelliJ IDEA.
 * User: vova
 * Date: 03.04.14
 * Time: 21:03
 */

namespace Soy\Bundle\SoyBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SearchFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('request', 'search');


    }

    public function getName()
    {
        return 'search';
    }
}