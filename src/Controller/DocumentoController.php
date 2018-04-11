<?php

namespace App\Controller;

use EasyCorp\Bundle\EasyAdminBundle\Controller\AdminController as BaseAdminController;

class DocumentoController extends BaseAdminController
{
    /**
     * @param object $entity
     */
    protected function prePersistEntity($entity)
    {
        $usuario = $this->getUser();
        $entity->setUsuarioSube($usuario);
    }

    /**
     * @param object $entity
     */
    protected function preUpdateEntity($entity)
    {
        $usuario = $this->getUser();
        $entity->setUsuarioSube($usuario);
    }
}
