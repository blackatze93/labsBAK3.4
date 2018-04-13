<?php

namespace App\Form;

use App\Entity\TrasladoElemento;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\EasyAdminAutocompleteType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TrasladoElementoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('elemento', EasyAdminAutocompleteType::class, array(
                'class' => 'App\Entity\Elemento',
            ))
            ->add('observacion')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TrasladoElemento::class,
        ]);
    }

    public function getBlockPrefix()
    {
        return 'traslado_elemento';
    }
}
