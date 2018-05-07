<?php

namespace App\Controller;

use App\Entity\Equipo;
use App\Entity\Lugar;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AdminController as BaseAdminController;

class EquipoController extends BaseAdminController
{
    /**
     * @param object $entity
     */
    protected function preRemoveEntity($entity)
    {
        foreach ($entity->getElementos() as $elemento) {
            $entity->removeElemento($elemento);
        }
    }

    /**
     * @param object $entity
     * @param string $view
     *
     * @return \Symfony\Component\Form\FormBuilder
     */
    protected function createEntityFormBuilder($entity, $view)
    {
        $builder = parent::createEntityFormBuilder($entity, $view);

        $formModifier = function (FormInterface $form, Lugar $lugar = null, Equipo $equipo = null) {
            $em = $this->getDoctrine()->getManager()->getRepository('App:Elemento');

            $elementos = null === $lugar ? array() : $em->findBy(
                array(
                    'lugar' => $lugar,
                    'activo' => true,
                    'equipo' => array(null, $equipo),
                ),
                array(
                    'tipo' => 'ASC',
                    'placa' => 'ASC',
                )
            );

            $form->add('elementos', EntityType::class, array(
                'class' => 'App\Entity\Elemento',
                'placeholder' => 'Ninguno',
                'required' => false,
                'choices' => $elementos,
                'multiple' => true,
                'by_reference' => false,
                'attr' => array(
                    'data-widget' => 'select2',
                ),
            ));
        };

        // Listener para edición
        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($formModifier) {
                // this would be your entity, i.e. SportMeetup
                $data = $event->getData();

                $formModifier($event->getForm(), $data->getLugar(), $data);
            }
        );

        // Listener para nuevo
        $builder->get('lugar')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($formModifier) {
                // It's important here to fetch $event->getForm()->getData(), as
                // $event->getData() will get you the client data (that is, the ID)
                $lugar = $event->getForm()->getData();

                // since we've added the listener to the child, we'll have to pass on
                // the parent to the callback functions!
                $formModifier($event->getForm()->getParent(), $lugar);
            }
        );

        return $builder;
    }
}
