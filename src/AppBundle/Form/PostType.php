<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class,
                ['label'=>'Titre'])
            ->add('text', TextareaType::class,
                [
                    'label' => 'Texte',
                    'required'=>true,
                    'attr' => ['rows'=>'10']
                ]
            )
            ->add('createdAt', DateType::class,
                ['label' => 'date de publication', 'widget'=>'single_text'])
            /*
            ->add('author', EntityType::class, [
                'class' => 'AppBundle\Entity\Author',
                'placeholder' => 'Choisissez un auteur',
                'choice_label' => 'fullName',
                //'expanded' => true,
                //'multiple' => true
            ])*/
            //->add('theme')
            ->add('submit', SubmitType::class,
                ['label'=>'Valider'])
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Post'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_post';
    }


}
