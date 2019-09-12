<?php

namespace AppBundle\Form;

use AppBundle\Entity\Episode;
use AppBundle\Entity\Season;
use AppBundle\Repository\SeasonRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NewEpisodeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Назва епізоду'
            ])
            ->add('duration', NumberType::class,[
                'label' => 'Тривалість'
            ])
            ->add('producer', TextType::class, [
                'label' => 'Продюсер'
            ])
            ->add('distributor', TextType::class, [
                'label' => 'Дистрибьютор'
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
            'data_class' => Episode::class,
        ]);
    }

}
