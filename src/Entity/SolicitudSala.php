<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SolicitudSalaRepository")
 * @DoctrineAssert\UniqueEntity(fields={"lugar", "fecha", "horaInicio", "horaFin"}, repositoryMethod="findRangoEvento",
 *     message="Ya existe un evento asociado a esa fecha y lugar. Seleccione otra fecha o lugar.", errorPath="fecha", )
 */
class SolicitudSala
{
    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    // TODO: pendiente, aprobado, rechazado

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=45)
     * @Assert\Length(max="45")
     */
    private $estado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     * @Assert\DateTime()
     */
    private $fechaSolicitud;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true   )
     * @Assert\DateTime()
     */
    private $fechaRespuesta;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="date")
     * @Assert\NotBlank()
     * @Assert\Date()
     */
    private $fecha;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hora_inicio", type="time")
     * @Assert\NotBlank()
     * @Assert\Time()
     */
    private $horaInicio;

    /**
     * @var \DateTime
     * @ORM\Column(name="hora_fin", type="time")
     * @Assert\NotBlank()
     * @Assert\Time()
     * @Assert\Expression(
     *     "this.getHoraInicio() < this.getHoraFin()",
     *     message="La hora final debe ser mayor a la hora de inicio"
     * )
     */
    private $horaFin;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $observaciones;

    /**
     * @var Usuario
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Usuario")
     * @ORM\JoinColumn(name="usuario_realiza_id", referencedColumnName="id", nullable=false)
     */
    private $usuarioRealiza;

    /**
     * @var Usuario
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Usuario")
     * @ORM\JoinColumn(name="usuario_responde_id", referencedColumnName="id", nullable=true)
     */
    private $usuarioResponde;

    /**
     * @var Lugar
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Lugar")
     * @ORM\JoinColumn(name="lugar_id", referencedColumnName="id", nullable=false, unique=false)
     * @Assert\NotBlank()
     */
    private $lugar;

    /**
     * @var Evento
     *
     * @ORM\OneToOne(targetEntity="App\Entity\Evento", cascade={"persist", "remove"}, orphanRemoval=true)
     * @ORM\JoinColumn(name="evento_id", referencedColumnName="id", nullable=false, unique=true)
     */
    private $evento;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * @param string $estado
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    /**
     * @return \DateTime
     */
    public function getFechaSolicitud()
    {
        return $this->fechaSolicitud;
    }

    /**
     * @param \DateTime $fechaSolicitud
     */
    public function setFechaSolicitud($fechaSolicitud)
    {
        $this->fechaSolicitud = $fechaSolicitud;
    }

    /**
     * @return \DateTime
     */
    public function getFechaRespuesta()
    {
        return $this->fechaRespuesta;
    }

    /**
     * @param \DateTime $fechaRespuesta
     */
    public function setFechaRespuesta($fechaRespuesta)
    {
        $this->fechaRespuesta = $fechaRespuesta;
    }

    /**
     * @return string
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }

    /**
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * @param \DateTime $fecha
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    /**
     * @return \DateTime
     */
    public function getHoraInicio()
    {
        return $this->horaInicio;
    }

    /**
     * @param \DateTime $horaInicio
     */
    public function setHoraInicio($horaInicio)
    {
        $this->horaInicio = $horaInicio;
    }

    /**
     * @return \DateTime
     */
    public function getHoraFin()
    {
        return $this->horaFin;
    }

    /**
     * @param \DateTime $horaFin
     */
    public function setHoraFin($horaFin)
    {
        $this->horaFin = $horaFin;
    }

    /**
     * @param string $observaciones
     */
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;
    }

    /**
     * @return Usuario
     */
    public function getUsuarioRealiza()
    {
        return $this->usuarioRealiza;
    }

    /**
     * @param Usuario $usuarioRealiza
     */
    public function setUsuarioRealiza($usuarioRealiza)
    {
        $this->usuarioRealiza = $usuarioRealiza;
    }

    /**
     * @return Usuario
     */
    public function getUsuarioResponde()
    {
        return $this->usuarioResponde;
    }

    /**
     * @param Usuario $usuarioResponde
     */
    public function setUsuarioResponde($usuarioResponde)
    {
        $this->usuarioResponde = $usuarioResponde;
    }

    /**
     * @return Lugar
     */
    public function getLugar()
    {
        return $this->lugar;
    }

    /**
     * @param Lugar $lugar
     */
    public function setLugar($lugar)
    {
        $this->lugar = $lugar;
    }

    /**
     * @return Evento
     */
    public function getEvento()
    {
        return $this->evento;
    }

    /**
     * @param Evento $evento
     */
    public function setEvento($evento)
    {
        $this->evento = $evento;
    }

    /**
     * @Assert\Callback
     *
     * @param ExecutionContextInterface $context
     */
    public function validarHoras(ExecutionContextInterface $context)
    {
        $horaInicio = $this->getHoraInicio()->format('H:i');
        $horaFin = $this->getHoraFin()->format('H:i');

        $horaMin = new \DateTime('06:00');
        $horaMin = $horaMin->format('H:i');

        $horaMax = new \DateTime('22:00');
        $horaMax = $horaMax->format('H:i');

        if ($horaInicio < $horaMin || $horaInicio > $horaMax) {
            $context->buildViolation('La hora debería estar entre las 6am y 10pm.')
                ->atPath('horaInicio')
                ->addViolation()
            ;
        } elseif ($horaFin < $horaMin || $horaFin > $horaMax) {
            $context->buildViolation('La hora debería estar entre las 6am y 10pm.')
                ->atPath('horaFin')
                ->addViolation()
            ;
        }
    }
}
