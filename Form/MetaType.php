<?php

namespace Mdespeuilles\MetaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\SubmitButton;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class MetaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('ogTitle')
            ->add('ogDescription')
            ->add('ogImageFile', VichImageType::class, [
                'required'      => false,
                'allow_delete'  => true,
                'download_link' => false, // not mandatory, default is true
            ])
            ->add('ogType')
            ->add('url', HiddenType::class)
            ->add('language', HiddenType::class)
            ->add('save', SubmitType::class)
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Mdespeuilles\MetaBundle\Entity\Meta'
        ));
    }
}
