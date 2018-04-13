<?php

namespace App\Form;

use App\Entity\Usuario;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UsuarioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tipoDocumento', ChoiceType::class, array(
                'choices' => array(
                    'C.C.' => 'Cédula de Ciudadanía',
                    'T.I.' => 'Tarjeta de Identidad',
                    'C.E.' => 'Cédula de Extranjería',
                ),
            ))
            ->add('documento')
            ->add('codigo')
            ->add('nombre')
            ->add('apellido')
            ->add('email', EmailType::class)
            ->add('passwordEnClaro', RepeatedType::class, array(
                'type' => PasswordType::class,
                'invalid_message' => 'Las dos contraseñas deben coincidir',
                'first_options' => array('label' => 'Contraseña'),
                'second_options' => array('label' => 'Confirmar Contraseña'),
                'first_name' => 'pass1',
                'second_name' => 'pass2',
                'required' => false,
            ))
            ->add('rol', ChoiceType::class, array(
                'choices' => array(
                    'ROLE_FUNCIONARIO' => 'ROLE_FUNCIONARIO',
                    'ROLE_DOCENTE' => 'ROLE_DOCENTE',
                    'ROLE_ESTUDIANTE' => 'ROLE_ESTUDIANTE',
                ),
                'choices_as_values' => true,
            ))
            ->add('cargo')
            ->add('dependencia', null, array(
                'empty_value' => 'Ninguna',
            ))
            ->add('proyectoCurricular', null, array(
                'empty_value' => 'Ninguno',
            ))
            ->add('restablecer', ResetType::class)
        ;

        // Dependiendo del tipo de form si es nuevo usuario o modificcacion se agrega el boton
        if ($options['accion'] === 'registro') {
            $builder
                ->add('crear', SubmitType::class)
            ;
        } elseif ($options['accion'] === 'modificar_perfil') {
            $builder
                ->add('guardar', SubmitType::class)
            ;
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Usuario::class,
            'accion' => 'modificar_perfil',
        ]);
    }

    public function getBlockPrefix()
    {
        return 'usuario';
    }
}
