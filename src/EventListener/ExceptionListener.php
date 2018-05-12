<?php

namespace App\EventListener;

use EasyCorp\Bundle\EasyAdminBundle\Exception\EntityRemoveException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Class ExceptionListener.
 */
class ExceptionListener
{
    private $router;

    /**
     * ExceptionListener constructor.
     *
     * @param Router  $router
     * @param Session $session
     */
    public function __construct(Router $router, Session $session)
    {
        $this->router = $router;
        $this->session = $session;
    }

    /**
     * @param GetResponseForExceptionEvent $event
     */
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        // You get the exception object from the received event
        $exception = $event->getException();

        if ($exception instanceof EntityRemoveException) {
            // Obtiene los datos de la entidad que genero la excepcion al intentar removerse
            $easyadmin = $event->getRequest()->attributes->get('easyadmin');
            // Genera la url a la lista de la entidad que genero la excepcion
            $url = $this->router->generate('easyadmin', array('action' => 'list', 'entity' => $easyadmin['entity']['name']));

            // Agrega el mensaje de error al flashbag
            $this->session->getFlashBag()->add('error', 'Error al eliminar el registro. La entidad tiene asociaciones en otras tablas.');
            // Redirecciona la pagina a la url generada
            $event->setResponse(new RedirectResponse($url));
        }
    }
}
