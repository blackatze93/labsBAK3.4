<?php

namespace App\Controller;

use App\Entity\Evento;
use App\Entity\SolicitudSala;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AdminController as BaseAdminController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Doctrine\ORM\EntityRepository;

class SolicitudSalaController extends BaseAdminController
{
    /**
     * @param object $entity
     */
    protected function preUpdateEntity($entity)
    {
        if ('Aprobada' == $entity->getEstado()) {
            $entity->setFechaRespuesta(new \DateTime());
            $entity->setUsuarioResponde($this->getUser());
        }
    }

    /**
     * Metodo que lista los objetos encontrados en el sitio web.
     *
     * @Security("has_role('ROLE_DOCENTE') or has_role('ROLE_FUNCIONARIO')")
     * @Route("/solicitud_sala/", name="solicitud_sala")
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function solicitudSalaAction(Request $request)
    {
        $solicitudSala = new SolicitudSala();

        // Se genera el formulario que permite crear el paz y salvo
        $form = $this->createFormBuilder($solicitudSala)
            ->add('fecha', DateType::class, array(
                'widget' => 'single_text',
                'html5' => false,
            ))
            ->add('horaInicio', TimeType::class, array(
                'widget' => 'single_text',
                'html5' => false,
            ))
            ->add('horaFin', TimeType::class, array(
                'widget' => 'single_text',
                'html5' => false,
            ))
            ->add('lugar', EntityType::class, array(
                'class' => 'App\Entity\Lugar',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('lugar')
                        ->where('lugar.visible = true');
                },
                'attr' => array(
                    'data-widget' => 'select2',
                ),
            ))
            ->add('observaciones', CKEditorType::class, array(
                'required' => false,
            ))
            ->add('crear', SubmitType::class)
            ->add('restablecer', ResetType::class)
            ->getForm()
        ;

        // Dejamos que symfony maneje el Request
        $form->handleRequest($request);

        // Si el formulario se ha enviado y es valido comprobamos el usuario
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $solicitudSala = $form->getData();
            $evento = new Evento();

            $solicitudSala->setFechaSolicitud(new \DateTime());
            $solicitudSala->setUsuarioRealiza($this->getUser());
            $solicitudSala->setEstado('Pendiente');
            $solicitudSala->setEvento($evento);
            $evento->setTipo('Reserva');
            $evento->setLugar($solicitudSala->getLugar());
            $evento->setUsuarioRegistra($this->getUser());
            $evento->setObservaciones($solicitudSala->getObservaciones());
            $evento->setFecha($solicitudSala->getFecha());

            $em->persist($solicitudSala);

            try {
                $em->flush();
                $this->addFlash('success', 'Se registró su solicitud correctamente');

                return $this->redirectToRoute('index');
            } catch (\Exception $e) {
                $this->addFlash('error', 'No se pudo registrar su solicitud');
            }
        }

        return $this->render('solicitud_sala.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
