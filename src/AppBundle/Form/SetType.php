<?php

namespace AppBundle\Form;

use AppBundle\Entity\Set;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('setAnswers', CollectionType::class, [
            'entry_type' => SetAnswerType::class,
            'entry_options' => [
                'label' => false
            ]
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Set::class,
        ]);
    }
}
