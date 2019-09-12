<?php

namespace AppBundle\Form;

use AppBundle\Entity\Serial;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NewSerialType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Назва серіалу'
            ])
            ->add('description', TextareaType::class,[
                'label' => 'Опис'
            ])
            ->add('genre', TextType::class,[
                'label' => 'Жанр'
            ])
            ->add('createdAt', DateTimeType::class, [
                'label' => 'Дата виходу',
                'years' => range(date('Y')-100, date('Y')+20),
                'placeholder' => [
                    'year' => 'Рік', 'month' => 'Місяць', 'day' => 'День'
                ]
            ])
            ->add('imagePath', FileType::class, [
                'label' => 'Зображення',
                'attr' => [
                    'accept' => "image/*",
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
            'data_class' => Serial::class,
        ]);
    }

}
