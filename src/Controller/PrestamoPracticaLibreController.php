<?php

namespace App\Controller;

use EasyCorp\Bundle\EasyAdminBundle\Controller\AdminController as BaseAdminController;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use App\Entity\Lugar;
use Doctrine\ORM\EntityRepository;

class PrestamoPracticaLibreController extends BaseAdminController
{
    /**
     * @param object $entity
     */
    protected function prePersistEntity($entity)
    {
        $usuario = $this->getUser();
        $entity->setUsuarioRealiza($usuario);

        if (!$entity->getHoraSalida()) {
            $entity->getEquipo()->setPrestado(true);
        } else {
            $entity->getEquipo()->setPrestado(false);
        }
    }

    /**
     * @param object $entity
     */
    protected function preUpdateEntity($entity)
    {
        if (!$entity->getHoraSalida()) {
            $entity->getEquipo()->setPrestado(true);
        } else {
            $entity->getEquipo()->setPrestado(false);
        }
    }

    /**
     * @param object $entity
     */
    protected function preRemoveEntity($entity)
    {
        $entity->getEquipo()->setPrestado(false);
    }

    public function salirAction()
    {
        // controllers extending the base AdminController can access to the
        // following variables:
        //   $this->request, stores the current request
        //   $this->em, stores the Entity Manager for this Doctrine entity

        // change the properties of the given entity and save the changes
        $id = $this->request->query->get('id');
        $entity = $this->em->getRepository('App:PrestamoPracticaLibre')->find($id);
        if (is_null($entity->getHoraSalida())){
            $entity->setHoraSalida(new \DateTime());
        }
        $entity->getEquipo()->setPrestado(false);
        $this->em->flush();

        // redirect to the 'list' view of the given entity
        return $this->redirectToRoute('easyadmin', array(
            'action' => 'list',
            'entity' => $this->request->query->get('entity'),
            'sortField' => 'horaSalida',
            'sortDirection' => 'ASC',
        ));
    }

    /**
     * @param object $entity
     * @param array  $entityProperties
     *
     * @return \Symfony\Component\Form\Form
     */
    protected function createEditForm($entity, array $entityProperties)
    {
        $builder = parent::createEditForm($entity, $entityProperties);

        $builder->add('lugar', EntityType::class, array(
            'class' => 'App\Entity\Lugar',
            'disabled' => true,
            'attr' => array(
                'data-widget' => 'select2',
            ),
        ));

        $builder->add('equipo', EntityType::class, array(
            'class' => 'App\Entity\Equipo',
            'disabled' => true,
            'attr' => array(
                'data-widget' => 'select2',
            ),
        ));

        return $builder;
    }

    /**
     * @param object $entity
     * @param string $view
     *
     * @return \Symfony\Component\Form\FormBuilder
     */
    protected function createEntityFormBuilder($entity, $view)
    {
        $builder = parent::createEntityFormBuilder($entity, $view);

        $builder->add('lugar', EntityType::class, array(
            'class' => 'App\Entity\Lugar',
            'placeholder' => 'Ninguno',
            'attr' => array(
                'data-widget' => 'select2',
            ),
            'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('lugar')
                    ->where('lugar.visible = true');
            },
        ));

        $formModifier = function (FormInterface $form, Lugar $lugar = null) {
            $em = $this->getDoctrine()->getManager()->getRepository('App:Equipo');

            $equipos = null === $lugar ? array() : $em->findBy(
                array(
                    'lugar' => $lugar,
                    'prestado' => false,
                ),
                array(
                    'nombre' => 'ASC',
                )
            );

            $form->add('equipo', EntityType::class, array(
                'class' => 'App\Entity\Equipo',
                'placeholder' => 'Ninguno',
                'choices' => $equipos,
                'attr' => array(
                    'data-widget' => 'select2',
                ),
            ));
        };

        // Listener para edición
        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($formModifier) {
                // this would be your entity, i.e. SportMeetup
                $data = $event->getData();

                $formModifier($event->getForm(), $data->getLugar());
            }
        );

        // Listener para nuevo
        $builder->get('lugar')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($formModifier) {
                // It's important here to fetch $event->getForm()->getData(), as
                // $event->getData() will get you the client data (that is, the ID)
                $lugar = $event->getForm()->getData();

                // since we've added the listener to the child, we'll have to pass on
                // the parent to the callback functions!
                $formModifier($event->getForm()->getParent(), $lugar);
            }
        );

        return $builder;
    }
}
