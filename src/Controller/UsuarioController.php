<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AdminController as BaseAdminController;

class UsuarioController extends BaseAdminController
{
    protected function prePersistEntity($entity)
    {
        // Se obtiene el encoder, que es el metodo de encriptacion de la entidad usuario
        $encoder = $this->get('security.encoder_factory')->getEncoder($entity);
        // Se codifica el password mediante el encoder
        $passwordCodificado = $encoder->encodePassword($entity->getPasswordEnClaro(), null);
        // Se establece el password en la entidad mediante el medoto setPassword
        $entity->setPassword($passwordCodificado);
    }

    protected function preUpdateEntity($entity)
    {
        if ($entity->getPasswordEnClaro() !== null) {
            $encoder = $this->get('security.encoder_factory')->getEncoder($entity);
            $passwordCodificado = $encoder->encodePassword($entity->getPasswordEnClaro(), null);
            $entity->setPassword($passwordCodificado);
        }
    }

    /**
     * Metodo que genera el form de login.
     *
     * @Route("/login/", name="usuario_login")
     */
    public function loginAction()
    {
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirectToRoute('admin');
        }

        // crear aqui el form de login
        $authUtils = $this->get('security.authentication_utils');

        return $this->render('usuario/login.html.twig', array(
            'last_username' => $authUtils->getLastUsername(),
            'error' => $authUtils->getLastAuthenticationError(),
        ));
    }

    /**
     * El "login check" lo hace Symfony automáticamente, por lo que
     * no hay que añadir ningún código en este método.
     *
     * @Route("/login_check", name="usuario_login_check")
     */
    public function loginCheckAction()
    {
    }

    /**
     * El logout lo hace Symfony automáticamente, por lo que
     * no hay que añadir ningún código en este método.
     *
     * @Route("/logout/", name="usuario_logout")
     */
    public function logoutAction()
    {
    }

}
