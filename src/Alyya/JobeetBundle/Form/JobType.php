<?php

namespace Alyya\JobeetBundle\Form;

use Alyya\JobeetBundle\Entity\Job;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JobType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type',ChoiceType::class , array(
                'choices'  =>  Job::getTypes()))
            ->add('category')
            ->add('company')
            ->add('logo', null , ['label' => 'Company logo'])
            ->add('file', FileType::class , ['label' => 'File' , 'required' => false])
            ->add('url')
            ->add('position')
            ->add('location')
            ->add('description')
            ->add('how_to_apply', null , ['label' => 'How to apply ?'])
            ->add('is_public', null , ['label' => 'Public ?'])
            ->add('is_activated')
            ->add('email')
            /*->add('expires_at', 'datetime')
            ->add('created_at', 'datetime')
            ->add('updated_at', 'datetime')*/

        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Alyya\JobeetBundle\Entity\Job'
        ));
    }
}
