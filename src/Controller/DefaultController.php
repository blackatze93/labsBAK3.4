<?php

namespace App\Controller;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Range;

class DefaultController extends Controller
{
    /**
     * Metodo que genera la pagina principal del sitio web.
     *
     * @Route("/", name="index")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $pagina = $em->getRepository('App:Pagina')->findOneBy(array(
            'id' => '1',
        ));

        return $this->render('index.html.twig', array(
            'pagina' => $pagina,
        ));
    }

    /**
     * Metodo que genera el paz y salvo.
     *
     * @Route("admin/editar_inicio/", name="editar_inicio")
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @internal param Request $request
     */
    public function editarInicioAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $pagina = $em->getRepository('App:Pagina')->findOneBy(array(
            'id' => '1',
        ));

        // Se genera el formulario que permite crear el paz y salvo
        $form = $this->createForm('App\Form\PaginaType', $pagina);

        // Dejamos que symfony maneje el Request
        $form->handleRequest($request);

        // Si el formulario se ha enviado y es valido comprobamos el usuario
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($pagina);

            try {
                $em->flush();
                $this->addFlash('success', 'Se actualizó la página de inicio correctamente');
            } catch (\Exception $e) {
                $this->addFlash('error', 'No se pudo actualizar la página de inicio');
            }
        }

        return $this->render('editar_inicio.html.twig', array(
            'form' => $form->createView(),
            'pagina' => $pagina,
        ));
    }

    /**
     * Metodo que genera el calendario.
     *
     * @Route("/calendario/", name="calendario")
     */
    public function calendarioAction()
    {
        return $this->render('calendario.html.twig');
    }

    /**
     * Metodo que genera el paz y salvo.
     *
     * @Route("/paz_y_salvo/", name="paz_y_salvo")
     *
     * @param Request $request
     *
     * @return mixed|\Symfony\Component\HttpFoundation\Response
     */
    public function pazYSalvoAction(Request $request)
    {
        // Se genera el formulario que permite crear el paz y salvo
        $defaultData = array();

        $options = array(
            'csrf_protection' => true,
        );

        $form = $this->createFormBuilder($defaultData, $options)
            ->add('codigo', TextType::class, array(
                'constraints' => array(
                    new NotBlank(),
                    new Range(array('min' => 1)),
                ),
            ))
            ->add('consultar', SubmitType::class)
            ->add('generar', SubmitType::class)
            ->getForm()
        ;

        // Dejamos que symfony maneje el Request
        $form->handleRequest($request);

        // Si el formulario se ha enviado y es valido comprobamos el usuario
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $usuario = $em->getRepository('App:Usuario')->findOneBy(array('codigo' => $data['codigo']));

            if ($usuario) {
                $pazSalvo = 'no';

                // Usamos una variable bandera para saber si el usuario esta en paz y salvo
                if ('Paz y Salvo' == $usuario->getEstado()) {
                    $pazSalvo = 'si';
                }

                // Si la opcion que selecciono fue generar y el usuario esta en paz y salvo procedemos a generarlo
                if ($form->get('generar')->isClicked() && 'si' == $pazSalvo) {
                    $reporte = new ReporteController();

                    return $reporte->crearPazSalvo($usuario, $this->get('t_fox_mpdf_port.pdf'), $this->container->get('assets.packages'));
                }
            } else {
                $pazSalvo = 'no_registrado';
            }

            return $this->render('paz_salvo.html.twig', array(
                'form' => $form->createView(),
                'pazSalvo' => $pazSalvo,
            ));
        }

        return $this->render('paz_salvo.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
