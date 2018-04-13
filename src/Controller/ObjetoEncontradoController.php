<?php

namespace App\Controller;

use EasyCorp\Bundle\EasyAdminBundle\Controller\AdminController as BaseAdminController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ObjetoEncontradoController extends BaseAdminController
{
    /**
     * @param object $entity
     */
    protected function prePersistEntity($entity)
    {
        $usuario = $this->getUser();
        $entity->setUsuarioRegistra($usuario);

        if ($entity->isEntregado() || $entity->getUsuarioReclama()) {
            $entity->setUsuarioEntrega($usuario);
            $entity->setFechaEntrega(new \DateTime());
        }
    }

    /**
     * @param object $entity
     */
    protected function preUpdateEntity($entity)
    {
        $usuario = $this->getUser();

        if ($entity->isEntregado() || $entity->getUsuarioReclama()) {
            $entity->setUsuarioEntrega($usuario);
            $entity->setFechaEntrega(new \DateTime());
        }
    }

    /**
     * Metodo que lista los objetos encontrados en el sitio web.
     *
     * @Route("/objetos_encontrados/", name="objetos_encontrados")
     */
    public function objetosEncontradosAction()
    {
        $em = $this->getDoctrine()->getManager();

        $objetos = $em->getRepository('App:ObjetoEncontrado')->findBy(
            array('entregado' => false),
            array('fechaRegistro' => 'DESC')
        );

        return $this->render('objetos_encontrados.html.twig', array(
            'objetos' => $objetos,
        ));
    }

    /**
     * @Route("/encontrados_bulk_delete/", name="encontrados_bulk_delete")
     * @Method({"POST"})
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function bulkDeleteAction(Request $request)
    {
        $response = new JsonResponse('', 400);

        if (!$request->isXmlHttpRequest()) {
            return $response;
        }

        $em = $this->getDoctrine()->getManager();
        $objetos = $em->getRepository('App:ObjetoEncontrado')->findAll();

        // Recorre el array de objetos para eliminar cada objeto
        foreach ($objetos as $objeto) {
            $em->remove($objeto);
        }

        try {
            $em->flush();
            $response->setStatusCode(200);
            $this->addFlash('success', 'Se borraron todos los objetos encontrados con éxito.');
        } catch (\Exception $e) {
        }

        return $response;
    }
}
