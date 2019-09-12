<?php

namespace AppBundle\Form;

use AppBundle\Entity\Season;
use AppBundle\Entity\Serial;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NewSeasonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Назва сезону'
            ])
            ->add('description', TextareaType::class,[
                'label' => 'Опис'
            ])
            ->add('startDate', DateTimeType::class, [
                'label' => 'Дата виходу',
                'years' => range(date('Y')-100, date('Y')+20),
                'placeholder' => [
                    'year' => 'Рік', 'month' => 'Місяць', 'day' => 'День'
                ]
            ])
            ->add('endDate', DateTimeType::class, [
                'label' => 'Дата закінчення',
                'years' => range(date('Y')-100, date('Y')+20),
                'placeholder' => [
                    'year' => 'Рік', 'month' => 'Місяць', 'day' => 'День'
                ]
            ])
            ->add('submit', SubmitType::class,[
                'label' => 'Додати'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Season::class,
        ]);
    }

}
