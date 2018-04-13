<?php

namespace App\Form;

use App\Entity\BajaElemento;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\EasyAdminAutocompleteType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BajaElementoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('elemento', EasyAdminAutocompleteType::class, array(
                'class' => 'App\Entity\Elemento',
            ))
            ->add('observacion')
            ->add('motivoBaja', EntityType::class, array(
                'class' => 'App\Entity\MotivoBaja',
                'attr' => array(
                    'data-widget' => 'select2',
                ),
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => BajaElemento::class,
        ]);
    }

    public function getBlockPrefix()
    {
        return 'baja_elemento';
    }
}
