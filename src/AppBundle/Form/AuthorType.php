<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AuthorType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, ['label'=>'Prénom', 'required'=>true])
            ->add('name', TextType::class, ['label'=>'Nom', 'required'=>true])
            ->add('email', RepeatedType::class, [
                'type' => EmailType::class,
                'first_options' => ['label' => 'Votre email', 'required'=>true],
                'second_options' => ['label' => 'Confirmation de vote email'],
                'invalid_message' => "L'email et sa confimation doivent être identiques"
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => ['label' => 'Votre mot de passe', 'required'=>true],
                'second_options' => ['label' => 'Confirmation de vote mot de passe'],
                'invalid_message' => "Le mot de passe et sa confimation doivent être identiques"
            ])
            ->add('submit', SubmitType::class, [
                'attr' =>['class' => 'btn btn-primary'], 'label'=>'Valider']
            );
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Author'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_author';
    }


}
