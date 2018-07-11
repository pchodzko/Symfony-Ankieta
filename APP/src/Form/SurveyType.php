<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use App\Entity\SurveyAnswer;

class SurveyType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('DOB', BirthdayType::class, array(
                    'placeholder' => 'Select a value',
                    'widget' => 'single_text'
                ))
                ->add('firstName')
                ->add('lastName')
                ->add('back', ButtonType::class, array(
                    'attr' => array('class' => 'back')))
                ->add('next', ButtonType::class, array(
                    'attr' => array('class' => 'next')))
                ->add('save', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => SurveyAnswer::class,
        ]);
    }

}
