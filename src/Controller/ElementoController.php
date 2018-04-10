<?php

namespace App\Controller;

use App\Entity\Lugar;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AdminController as BaseAdminController;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;

class ElementoController extends BaseAdminController
{
    /**
     * @param object $entity
     * @param string $view
     *
     * @return \Symfony\Component\Form\FormBuilder
     */
    protected function createEntityFormBuilder($entity, $view)
    {
        $builder = parent::createEntityFormBuilder($entity, $view);

        $formModifier = function (FormInterface $form, Lugar $lugar = null) {
            $em = $this->getDoctrine()->getManager()->getRepository('App:Equipo');

            $equipos = null === $lugar ? array() : $em->findBy(
                array(
                    'lugar' => $lugar,
                ),
                array(
                    'nombre' => 'ASC',
                )
            );

            $form->add('equipo', EntityType::class, array(
                'class' => 'App\Entity\Equipo',
                'placeholder' => 'Ninguno',
                'choices' => $equipos,
                'required' => false,
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

                $formModifier($event->getForm(), $data->getLugar());
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

    /**
     * @return JsonResponse
     */
    protected function autocompleteAction()
    {
        $referer = $this->request->headers->get('referer');
        $isPrestamo = strpos($referer, 'PrestamoElemento');
        $dqlFilter = null;

        if ($isPrestamo) {
            $dqlFilter = 'entity.activo = true and entity.prestado = false and entity.tipoPrestamo != \'Nadie\'';
        } else {
            $dqlFilter = 'entity.activo = true and entity.prestado = false';
        }

        $results = $this->get('easyadmin.autocomplete')->find(
            $this->request->query->get('entity'),
            $this->request->query->get('query'),
            $this->request->query->get('page', 1),
            $dqlFilter
        );

        return new JsonResponse($results);
    }

    /**
     * Metodo que lista los objetos encontrados en el sitio web.
     *
     * @Route("/elementos_prestamo/", name="elementos_prestamo")
     */
    public function elementosPrestamoAction()
    {
        $em = $this->getDoctrine()->getManager();

        $elementos = $em->getRepository('App:Elemento')->findBy(
            array(
                'activo' => true,
                'prestado' => false,
                'tipoPrestamo' => 'Todos',
            ),
            array('tipo' => 'ASC')
        );

        return $this->render('elementos_prestamo.html.twig', array(
            'elementos' => $elementos,
        ));
    }
}
