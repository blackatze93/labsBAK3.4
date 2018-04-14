<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Ob\HighchartsBundle\Highcharts\Highchart;
use Symfony\Component\Validator\Constraints\Expression;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Class GraficoController.
 *
 * * @Route("/admin/graficos/")
 */
class GraficoController extends Controller
{
    /**
     * Metodo que genera el paz y salvo.
     *
     * @Route("practica_libre_mes/", name="practica_libre_mes")
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @internal param Request $request
     */
    public function practicaLibreMesAction(Request $request)
    {
        // Se genera el formulario que permite crear el paz y salvo
        $form = $this->createFormBuilder(null,
            array(
                'constraints' => array(
                    new Expression(array(
                        'expression' => 'value["mesFin"] >= value["mesInicio"]',
                        'message' => 'El mes final debe ser mayor que el mes inicial.',
                    )),
                ),
            )
        )
            ->add('anio', ChoiceType::class, array(
                'choices' => array_combine(range(date('Y'), date('Y') - 4), range(date('Y'), date('Y') - 4)),
                'constraints' => array(
                    new NotBlank(),
                ),
            ))
            ->add('mesInicio', ChoiceType::class, array(
                'choices' => array(
                    'Enero' => 0,
                    'Febrero' => 1,
                    'Marzo' => 2,
                    'Abril' => 3,
                    'Mayo' => 4,
                    'Junio' => 5,
                    'Julio' => 6,
                    'Agosto' => 7,
                    'Septiembre' => 8,
                    'Octubre' => 9,
                    'Noviembre' => 10,
                    'Diciembre' => 11
                ),
                'constraints' => array(
                    new NotBlank(),
                ),
            ))
            ->add('mesFin', ChoiceType::class, array(
                'choices' => array(
                    'Enero' => 0,
                    'Febrero' => 1,
                    'Marzo' => 2,
                    'Abril' => 3,
                    'Mayo' => 4,
                    'Junio' => 5,
                    'Julio' => 6,
                    'Agosto' => 7,
                    'Septiembre' => 8,
                    'Octubre' => 9,
                    'Noviembre' => 10,
                    'Diciembre' => 11
                ),
                'constraints' => array(
                    new NotBlank(),
                ),
            ))
            ->add('generar', SubmitType::class)
            ->getForm()
        ;

        // Dejamos que symfony maneje el Request
        $form->handleRequest($request);

        // Si el formulario se ha enviado y es valido comprobamos el usuario
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $anio = $data['anio'];

            $em = $this->getDoctrine()->getManager();
            $prestamos = $em->getRepository('App:PrestamoPracticaLibre')->findPrestamosRango(
                array(
                    'anio' => $anio,
                    'mesInicio' => ($data['mesInicio'] + 1),
                    'mesFin' => ($data['mesFin'] + 1),
                ));

            $data = array();
            $drilldown = array();

            for ($i = 0; $i < count($prestamos); ++$i) {
                $drilldown_data = array();
                $mes_info = array(
                    'y' => (int) $prestamos[$i]['total'],
                    'x' => (int) $prestamos[$i]['mes'],
                    'drilldown' => $prestamos[$i]['mes'],
                );

                $prestamosMes = $em->getRepository('App:PrestamoPracticaLibre')->findPrestamosMes(
                    array(
                        'mes' => $prestamos[$i]['mes'],
                        'anio' => $anio
                    ));

                for ($j = 0; $j < count($prestamosMes); ++$j) {
                    $dia_info = array(
                        (int) $prestamosMes[$j]['dia'],
                        (int) $prestamosMes[$j]['total'],
                    );
                    array_push($drilldown_data, $dia_info);
                }

                $drilldown_info = array(
                    'name' => $prestamos[$i]['mes'],
                    'id' => $prestamos[$i]['mes'],
                    'xAxis' => 1,
                    'colorByPoint' => true,
                    'data' => $drilldown_data,
                );

                array_push($drilldown, $drilldown_info);
                array_push($data, $mes_info);
            }

            $ob = new Highchart();
            $ob->title->text('Préstamos Practica Libre');
            $ob->chart->renderTo('container');  // The #id of the div where to render the chart
            $ob->chart->type('column');
            $ob->credits->enabled(false);
            $ob->legend->enabled(false);
            $ob->yAxis->title(array('text' => 'Cantidad'));
            $ob->yAxis->allowDecimals(false);
            $ob->xAxis(array(
                array(
                    'id' => 0,
                    'type' => 'category',
                    'categories' => array('', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'),
                ),
                array(
                    'id' => 1,
                    'type' => 'category',
                ),
            ));
            $ob->series(
                array(
                    array(
                        'name' => 'Préstamos por mes',
                        'xAxis' => 0,
                        'colorByPoint' => true,
                        'data' => $data,
                    ),
                )
            );
            $ob->drilldown->series($drilldown);

            return $this->render('grafico/practica_libre_mes.html.twig', array(
                'form' => $form->createView(),
                'chart' => $ob,
            ));
        }

        return $this->render('grafico/practica_libre_mes.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
