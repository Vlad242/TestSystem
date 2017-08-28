<?php

namespace AppBundle\Form;

use AppBundle\Entity\Answer;
use AppBundle\Entity\SetAnswer;
use AppBundle\Repository\AnswerRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SetAnswerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('answer', EntityType::class, [
                'class' => Answer::class,
                'multiple' => false,
                'expanded' => true
            ])

            ->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
                /** @var SetAnswer $setAnswer */
                $setAnswer = $event->getData();

                if ($event->getForm()->has('answer')) {
                    $event->getForm()->remove('answer');
                }

                $event->getForm()
                    ->add('answer', EntityType::class, [
                        'class' => Answer::class,
                        'query_builder' => function (AnswerRepository $ar) use ($setAnswer) {
                            return $ar->createQueryBuilder('a')->join('a.question', 'q')
                                ->andWhere('q = :question')
                                ->setParameter('question', $setAnswer->getQuestion());
                        },
                        'label' => $setAnswer->getQuestion()->getName(),
                        'multiple' => false,
                        'expanded' => true
                    ]);
            });
    }



    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SetAnswer::class,
        ]);

    }
}
