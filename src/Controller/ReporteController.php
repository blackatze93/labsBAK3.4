<?php

namespace App\Controller;

use EasyCorp\Bundle\EasyAdminBundle\Form\Type\EasyAdminAutocompleteType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Class ReporteController.
 *
 * @Route("/admin/reportes/")
 */
class ReporteController extends Controller
{
    /**
     * Metodo que genera el paz y salvo.
     *
     * @Route("paz_salvo/", name="paz_salvo")
     *
     * @param Request $request
     *
     * @return mixed|\Symfony\Component\HttpFoundation\Response
     */
    public function pazSalvoAction(Request $request)
    {
        // Se genera el formulario que permite crear el paz y salvo
        $form = $this->createFormBuilder()
            ->add('usuario', EasyAdminAutocompleteType::class, array(
                'class' => 'App\Entity\Usuario',
                'constraints' => array(
                    new NotBlank(),
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
            $usuario = $data['usuario'];
            $pazSalvo = 'no';

            // Usamos una variable bandera para saber si el usuario esta en paz y salvo
            if ('Paz y Salvo' == $usuario->getEstado()) {
                $pazSalvo = 'si';
            }

            // Si la opcion que selecciono fue generar y el usuario esta en paz y salvo procedemos a generarlo
            if ($form->get('generar')->isClicked() && 'si' == $pazSalvo) {
                return $this->crearPazSalvo($usuario, $this->get('t_fox_mpdf_port.pdf'), $this->get('assets.packages'));
            }

            return $this->render('reporte/paz_salvo.html.twig', array(
                'form' => $form->createView(),
                'pazSalvo' => $pazSalvo,
            ));
        }

        return $this->render('reporte/paz_salvo.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @param $usuario
     * @param $mpdfService
     * @param $helper_assets
     *
     * @return mixed
     */
    public function crearPazSalvo($usuario, $mpdfService, $helper_assets)
    {
        $fecha = new \DateTime();
        $formatter = new \IntlDateFormatter('es', \IntlDateFormatter::SHORT, \IntlDateFormatter::SHORT);

        $formatter->setPattern('dd');
        $dia = $formatter->format($fecha);

        $formatter->setPattern('LLLL');
        $mes = $formatter->format($fecha);

        $formatter->setPattern('y');
        $anio = $formatter->format($fecha);

        $escudo = $helper_assets->getUrl('img/escudo.png');
        $sigud = $helper_assets->getUrl('img/sigud.png');
        $css = $helper_assets->getUrl('css/paz_salvo.css');

        $html = '
                <!DOCTYPE html>
                <html>
                    <head>
                        <title>Paz y Salvo</title>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <link rel="stylesheet" href="'.$css.'">
                    </head>
                    <body>
                    <table class="encabezado">
                        <tr>
                            <td rowspan="3"><img src="'.$escudo.'" alt="Logo UD" ></td>
                            <td class="titulo">FORMATO DE PAZ Y SALVO</td>
                            <td class="Cod">Código: GL-PR008-FR-010</td>
                            <td rowspan="3"><img class="logoSIGUD" src="'.$sigud.'" alt="Logo SIGUD" ></td>
                        </tr>
                        <tr>
                            <td class="MP">Macro proceso: Apoyo a lo misional</td>
                            <td class="Cod">Versión: 02</td>
                        </tr>
                        <tr>
                            <td class="PG">Proceso: Gestión de Laboratorios de Informática</td>
                            <td class="Cod">Fecha de aprobación: 03/09/2014</td>
                        </tr>
                    </table> 
                    <br><br><br><br><br>
                    <p align="justify">
                        Los <b>Laboratorios de Informática</b> de la Facultad Tecnológica, hacen constar que el 
                        estudiante <b>'.$usuario->getNombre().' '.$usuario->getApellido().'</b> identificado con código <b>'
                        .$usuario->getCodigo().'</b>, se encuentra a paz y salvo por todo concepto en el mencionado laboratorio.
                        <br><br><br><br><br>El presente certificado se expide por solicitud del interesado a los '
                        .$dia.' día(s) del mes de '.$mes.' de '.$anio
                        .'.<br><br><br><br><br><br><br>
                        Atentamente,<br><br><br><br><br><br><br>
            
                        _____________________________<br>
                        <b>ING. LUIS FELIPE WANUMEN SILVA</b><br>
                        Coordinador Laboratorios de Informática<br>
                        Universidad Distrital Francisco José de Caldas<br>
                        Facultad Tecnológica<br>
                    </p>
                </body>
                </html>
                ';

        return new \TFox\MpdfPortBundle\Response\PDFResponse($mpdfService->generatePdf($html));
    }
}
