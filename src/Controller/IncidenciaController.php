<?php

namespace App\Controller;

use EasyCorp\Bundle\EasyAdminBundle\Controller\AdminController as BaseAdminController;

class IncidenciaController extends BaseAdminController
{
    /**
     * @param object $entity
     */
    protected function prePersistEntity($entity)
    {
        $usuario = $this->getUser();
        $entity->setUsuarioRegistra($usuario);

        $entity->setFechaRegistro(new \DateTime());

        $entity->setEstado('Pendiente');
    }

    /**
     * @param object $entity
     */
    protected function preUpdateEntity($entity)
    {
        $usuario = $this->getUser();

        if ('Atendida' == $entity->getEstado()) {
            $entity->setUsuarioAtiende($usuario);
            $entity->setFechaAtencion(new \DateTime());
        }
    }
}
