<?php

namespace App\Controller;

use EasyCorp\Bundle\EasyAdminBundle\Controller\AdminController as BaseAdminController;

class PrestamoElementoController extends BaseAdminController
{
    /**
     * @param object $entity
     */
    protected function prePersistEntity($entity)
    {
        $usuario = $this->getUser();
        $entity->setUsuarioRealiza($usuario);

        if (!$entity->getFechaDevolucion()) {
            $entity->getElemento()->setPrestado(true);
        } else {
            $entity->getElemento()->setPrestado(false);
        }
    }

    /**
     * @param object $entity
     */
    protected function preUpdateEntity($entity)
    {
        if (!$entity->getFechaDevolucion()) {
            $entity->getElemento()->setPrestado(true);
        } else {
            $entity->getElemento()->setPrestado(false);
        }
    }

    /**
     * @param object $entity
     */
    protected function preRemoveEntity($entity)
    {
        $entity->getElemento()->setPrestado(false);
    }

    public function salirAction()
    {
        // controllers extending the base AdminController can access to the
        // following variables:
        //   $this->request, stores the current request
        //   $this->em, stores the Entity Manager for this Doctrine entity

        // change the properties of the given entity and save the changes
        $id = $this->request->query->get('id');
        $entity = $this->em->getRepository('App:PrestamoElemento')->find($id);
        if (is_null($entity->getFechaDevolucion())){
            $entity->setFechaDevolucion(new \DateTime());
        }
        $entity->getElemento()->setPrestado(false);
        try {
            $this->em->flush();
        } catch (\Exception $e) {
        }

        // redirect to the 'list' view of the given entity
        return $this->redirectToRoute('easyadmin', array(
            'action' => 'list',
            'entity' => $this->request->query->get('entity'),
            'sortField' => 'fechaDevolucion',
            'sortDirection' => 'ASC',
        ));
    }
}
