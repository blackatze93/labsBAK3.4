<?php

namespace App\EventListener;

use App\Event\CalendarEvent;
use App\Entity\EventEntity;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

/**
 * Class CalendarEventListener.
 */
class CalendarEventListener
{
    private $entityManager;
    private $router;
    private $authorizationChecker;

    /**
     * CalendarEventListener constructor.
     *
     * @param EntityManager                 $entityManager
     * @param Router                        $router
     * @param AuthorizationCheckerInterface $authorizationChecker
     */
    public function __construct(EntityManager $entityManager, Router $router, AuthorizationCheckerInterface $authorizationChecker)
    {
        $this->entityManager = $entityManager;
        $this->router = $router;
        $this->authorizationChecker = $authorizationChecker;
    }

    /**
     * @param CalendarEvent $calendarEvent
     */
    public function loadEvents(CalendarEvent $calendarEvent)
    {
        $startDate = $calendarEvent->getStartDatetime();
        $endDate = $calendarEvent->getEndDatetime();

        // load events using your custom logic here,
        // for instance, retrieving events from a repository

        $eventos = $this->entityManager->getRepository('App:Evento')
            ->createQueryBuilder('eventos')
            ->where('eventos.fecha BETWEEN :startDate and :endDate')
            ->setParameter('startDate', $startDate->format('Y-m-d'))
            ->setParameter('endDate', $endDate->format('Y-m-d'))
            ->getQuery()->getResult();

        // $eventos and $evento in this example
        // represent entities from your database, NOT instances of EventEntity
        // within this bundle.
        //
        // Create EventEntity instances and populate it's properties with data
        // from your own entities/database values.

        foreach ($eventos as $evento) {
            $fecha = $evento->getFecha();
            $horaInicio = $evento->getHoraInicio();
            $horaFin = $evento->getHoraFin();
            $fechaInicio = new \DateTime($fecha->format('Y-m-d').' '.$horaInicio->format('H:i'));
            $fechaFin = new \DateTime($fecha->format('Y-m-d').' '.$horaFin->format('H:i'));

//           $evento = new Evento();

            // create an event with a start/end time
            $eventEntity = new EventEntity($evento->getTipo(), $fechaInicio, $fechaFin);

            //optional calendar event settings
            if ($this->authorizationChecker->isGranted('ROLE_ADMIN')) {
                $eventEntity->setUrl($this->router->generate('easyadmin', array('action' => 'show', 'id' => $evento->getId(), 'entity' => 'Evento'))); // url to send user to when event label is clicked
            }
            $eventEntity->addField('resourceId', $evento->getLugar()->getId());
            if ($evento->getAsignatura()) {
                $eventEntity->addField('asignatura', $evento->getAsignatura()->getNombre());
            }
            $eventEntity->addField('tipo', $evento->getTipo());
            $eventEntity->addField('grupo', $evento->getGrupo());
            $eventEntity->addField('observaciones', $evento->getObservaciones());

            //finally, add the event to the CalendarEvent for displaying on the calendar
            $calendarEvent->addEvent($eventEntity);
        }
    }
}