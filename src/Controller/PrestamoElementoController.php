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
}
