<?php

namespace ForumBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('subject',TextType::class,['label'=> "Titre du post"])
            //->add('createdAt')
            ->add('text', TextareaType::class, ['label'=> "Corps du Post", 'attr'=>['rows'=>8]])
            ->add('user', EntityType::class, [
                'class'=>'ForumBundle\Entity\Post',
                'placeholder'=>'Renseigner un utilisateur',
                'choice_label'=>'fullName'])
            ->add('submit', SubmitType::class,
                ['label'=>'valider',
                    'attr'=>['class'=>'btn btn-primary btn-block']])
        ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ForumBundle\Entity\Post'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'forumbundle_post';
    }


}
