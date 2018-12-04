<?php

namespace App\Form;

use App\Entity\Pagina;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PaginaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('contenido', CKEditorType::class, array(
                'config_name' => 'full_config',
                'required' => false,
            ))
            ->add('guardar', SubmitType::class)
            ->add('restablecer', ResetType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Pagina::class,
        ]);
    }

    public function getBlockPrefix()
    {
        return 'pagina';
    }
}
