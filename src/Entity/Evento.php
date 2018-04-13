<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EventoRepository")
 * @DoctrineAssert\UniqueEntity(fields={"lugar", "fecha", "horaInicio", "horaFin"}, repositoryMethod="findRangoEvento",
 *     message="Ya existe un evento asociado a esa fecha y lugar.", errorPath="fecha")
 */
class Evento
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=false, unique=false)
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
     * @var int
     *
     * @Assert\NotBlank(groups={"New"})
     * @Assert\Range(min="1", max="50")
     */
    private $semanas;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", nullable=false, unique=false)
     * @Assert\NotBlank()
     * @Assert\Length(max="45")
     */
    private $tipo;

    /**
     * @var Asignatura
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Asignatura")
     * @ORM\JoinColumn(name="asignatura_id", referencedColumnName="id", nullable=true, unique=false)
     * @Assert\NotBlank(groups={"New"})
     */
    private $asignatura;

    /**
     * @var string
     *
     * @ORM\Column(name="grupo", type="string", length=10, unique=false, nullable=true)
     * @Assert\NotBlank(groups={"New"})
     * @Assert\Length(max="10")
     */
    private $grupo;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text", nullable=true)
     */
    private $observaciones;

    /**
     * @var Lugar
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Lugar")
     * @ORM\JoinColumn(name="lugar_id", referencedColumnName="id", nullable=false, unique=false)
     * @Assert\NotBlank()
     */
    private $lugar;

    /**
     * @var Usuario
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Usuario")
     * @ORM\JoinColumn(name="usuario_registra_id", referencedColumnName="id", nullable=false)
     */
    private $usuarioRegistra;

    /**
     * Evento constructor.
     */
    public function __construct()
    {
        $this->fecha = new \DateTime();
        $this->horaInicio = new \DateTime();
        $this->horaFin = new \DateTime('+2 hours');
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
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
     * @return int
     */
    public function getSemanas()
    {
        return $this->semanas;
    }

    /**
     * @param int $semanas
     */
    public function setSemanas($semanas)
    {
        $this->semanas = $semanas;
    }

    /**
     * @return string
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * @param string $tipo
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    /**
     * @return string
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }

    /**
     * @param string $observaciones
     */
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;
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
     * @return Usuario
     */
    public function getUsuarioRegistra()
    {
        return $this->usuarioRegistra;
    }

    /**
     * @param Usuario $usuarioRegistra
     */
    public function setUsuarioRegistra($usuarioRegistra)
    {
        $this->usuarioRegistra = $usuarioRegistra;
    }

    /**
     * @return string
     */
    public function getGrupo()
    {
        return $this->grupo;
    }

    /**
     * @param string $grupo
     */
    public function setGrupo($grupo)
    {
        $this->grupo = $grupo;
    }

    /**
     * @return Asignatura
     */
    public function getAsignatura()
    {
        return $this->asignatura;
    }

    /**
     * @param Asignatura $asignatura
     */
    public function setAsignatura($asignatura)
    {
        $this->asignatura = $asignatura;
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
