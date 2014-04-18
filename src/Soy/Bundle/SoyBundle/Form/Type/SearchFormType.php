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
        $builder->add('name', 'text')
            ->add('number', 'text')
            ->add('artist', 'text')
            ->add('text', 'text')
            ->add('powerCompare', 'choice', $this->getCompareChoices())
            ->add('power', 'integer')
            ->add('toughnessCompare', 'choice', $this->getCompareChoices())
            ->add('toughness', 'integer')
            ->add('mana', 'text')
            ->add('formats', 'entity', array(
                'class' => 'SoyBundle:Format',
                'property' => 'name',
                'expanded' => true,
                'multiple' => true
            ))
            ->add('type', 'entity', array(
                'class' => 'SoyBundle:Type',
                'property' => 'name',
                'multiple' => false,
                'required' => false,
            ))
            ->add('editions', 'entity', array(
                'class' => 'SoyBundle:Edition',
                'property' => 'name',
                'multiple' => true
            ))
            ->add('search', 'submit');
    }

    public function getName()
    {
        return 'search';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Soy\Bundle\SoyBundle\Entity\Search',
        ));
    }

    public function getCompareChoices()
    {
        return array(
            'choices'   => array(
                'equal' => '=',
                'less' => '<',
                'more' => '>',
                'lessOrEqual' => '<=',
                'moreOrEqual' => '>='
            ),
            'required'  => true,
        );
    }

}