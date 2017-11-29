<?php

namespace AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
class PostType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title')
                ->add('body')
                ->add('datepublish', DateType::class , array(
                    'widget' => 'single_text',
                    'data'   => new \DateTime(),
                    'format' => 'yyyy-MM-dd'
                ))
                ->add('image', FileType::class, array(
                    'label' => 'image PNG, JPEG',
                    'data_class' => null,
                    'required' => false
                ))
                ->add('categories', EntityType::class, array(
                    'class' => 'AdminBundle\Entity\Category',
                    'choice_label' => 'title',
                    'expanded' => false,
                    'multiple' => true
                ))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AdminBundle\Entity\Post'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'adminbundle_post';
    }


}
