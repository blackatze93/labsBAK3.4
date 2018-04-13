<?php

namespace App\Controller;

use App\Entity\Evento;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AdminController as BaseAdminController;
use EasyCorp\Bundle\EasyAdminBundle\Event\EasyAdminEvents;

class EventoController extends BaseAdminController
{
    /**
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    protected function newAction()
    {
        $this->dispatch(EasyAdminEvents::PRE_NEW);

        $entity = $this->createNewEntity();

        $easyadmin = $this->request->attributes->get('easyadmin');
        $easyadmin['item'] = $entity;
        $this->request->attributes->set('easyadmin', $easyadmin);

        $fields = $this->entity['new']['fields'];

        $newForm = $this->createNewForm($entity, $fields);

        $newForm->handleRequest($this->request);
        if ($newForm->isSubmitted() && $newForm->isValid()) {
            $this->dispatch(EasyAdminEvents::PRE_PERSIST, array('entity' => $entity));

            $this->prePersistEntity($entity);

            // Crea un nuevo EntityManager para este proceso
            $em = $this->getDoctrine()->getManager();
            $validator = $this->get('validator');

            // Obtiene el usuario logueado
            $usuario = $this->getUser();

            // Obtiene la cantidad de semanas que se debe repetir el evento
            $semanas = $entity->getSemanas();

            // Se crean tantos eventos como repeticiones en el campo semanas se indica
            for ($i = 0; $i < $semanas; ++$i) {
                $evento = new Evento();
                $fechaAux = clone $entity->getFecha();
                $fecha = $fechaAux->modify('+'.$i.' week');
                $evento->setLugar($entity->getLugar());
                $evento->setFecha($fecha);
                $evento->setHoraInicio($entity->getHoraInicio());
                $evento->setHoraFin($entity->getHoraFin());
                $evento->setTipo($entity->getTipo());
                $evento->setAsignatura($entity->getAsignatura());
                $evento->setGrupo($entity->getGrupo());
                $evento->setUsuarioRegistra($usuario);
                $evento->setObservaciones($entity->getObservaciones());

                $errors = $validator->validate($evento);
                if (count($errors) > 0) {
                    $this->addFlash('error', 'No se pudo agregar el evento del '.$fecha->format('Y-m-d'));
                } else {
                    $em->persist($evento);
                    // Se tiene que guardar cada objeto en la BD para poder comprobar el constraint valido
                    try {
                        $em->flush();
                        $this->addFlash('success', 'Se agregó el evento del '.$fecha->format('Y-m-d'));
                    } catch (\Exception $e) {
                        $this->addFlash('error', 'No se pudo agregar el evento del '.$fecha->format('Y-m-d'));
                    }
                }
            }

            $this->dispatch(EasyAdminEvents::POST_PERSIST, array('entity' => $entity));

            $refererUrl = $this->request->query->get('referer', '');

            return !empty($refererUrl)
                ? $this->redirect(urldecode($refererUrl))
                : $this->redirect($this->generateUrl('easyadmin', array('action' => 'list', 'entity' => $this->entity['name'])));
        }

        $this->dispatch(EasyAdminEvents::POST_NEW, array(
            'entity_fields' => $fields,
            'form' => $newForm,
            'entity' => $entity,
        ));

        return $this->render($this->entity['templates']['new'], array(
            'form' => $newForm->createView(),
            'entity_fields' => $fields,
            'entity' => $entity,
        ));
    }
}
