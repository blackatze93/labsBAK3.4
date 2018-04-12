<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PrestamoPracticaLibreRepository")
 */
class PrestamoPracticaLibre
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="date")
     * @Assert\NotBlank()
     * @Assert\Date()
     */
    private $fechaPrestamo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="time")
     * @Assert\NotBlank()
     * @Assert\Time()
     */
    private $horaEntrada;

    /**
     * @var \DateTime
     * @ORM\Column(type="time", nullable=true)
     * @Assert\Time()
     */
    private $horaSalida;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text", nullable=true)
     */
    private $observaciones;

    /**
     * @var Usuario
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Usuario")
     * @ORM\JoinColumn(name="usuario_solicita_id", referencedColumnName="id", nullable=false, unique=false)
     * @Assert\NotBlank()
     */
    private $usuarioSolicita;

    /**
     * @var Equipo
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Equipo")
     * @ORM\JoinColumn(name="equipo_id", referencedColumnName="id", nullable=false, unique=false)
     * @Assert\NotBlank()
     */
    private $equipo;

    /**
     * @var Usuario
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Usuario")
     * @ORM\JoinColumn(name="usuario_realiza_id", referencedColumnName="id", nullable=false, unique=false)
     */
    private $usuarioRealiza;

    /**
     * @var Lugar
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Lugar")
     * @ORM\JoinColumn(name="lugar_id", referencedColumnName="id", nullable=false, unique=false)
     * @Assert\NotBlank()
     */
    private $lugar;

    /**
     * PrestamoPracticaLibre constructor.
     */
    public function __construct()
    {
        $this->fechaPrestamo = new \DateTime();
        $this->horaEntrada = new \DateTime();
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
    public function getFechaPrestamo()
    {
        return $this->fechaPrestamo;
    }

    /**
     * @param \DateTime $fechaPrestamo
     */
    public function setFechaPrestamo($fechaPrestamo)
    {
        $this->fechaPrestamo = $fechaPrestamo;
    }

    /**
     * @return \DateTime
     */
    public function getHoraEntrada()
    {
        return $this->horaEntrada;
    }

    /**
     * @param \DateTime $horaEntrada
     */
    public function setHoraEntrada($horaEntrada)
    {
        $this->horaEntrada = $horaEntrada;
    }

    /**
     * @return \DateTime
     */
    public function getHoraSalida()
    {
        return $this->horaSalida;
    }

    /**
     * @param \DateTime $horaSalida
     */
    public function setHoraSalida($horaSalida)
    {
        $this->horaSalida = $horaSalida;
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
    public function getUsuarioSolicita()
    {
        return $this->usuarioSolicita;
    }

    /**
     * @param Usuario $usuarioSolicita
     */
    public function setUsuarioSolicita($usuarioSolicita)
    {
        $this->usuarioSolicita = $usuarioSolicita;
    }

    /**
     * @return Equipo
     */
    public function getEquipo()
    {
        return $this->equipo;
    }

    /**
     * @param Equipo $equipo
     */
    public function setEquipo($equipo)
    {
        $this->equipo = $equipo;
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
     * @Assert\Callback
     *
     * @param ExecutionContextInterface $context
     */
    public function validarHoras(ExecutionContextInterface $context)
    {
        if ($this->getHoraEntrada()) {
            $horaEntrada = $this->getHoraEntrada()->format('H:i');

            $horaMin = new \DateTime('06:00');
            $horaMin = $horaMin->format('H:i');

            $horaMax = new \DateTime('22:00');
            $horaMax = $horaMax->format('H:i');

            if ($horaEntrada < $horaMin || $horaEntrada > $horaMax) {
                $context->buildViolation('La hora debería estar entre las 6am y 10pm.')
                    ->atPath('horaEntrada')
                    ->addViolation()
                ;
            }

            if ($this->getHoraSalida()) {
                $horaSalida = $this->getHoraSalida()->format('H:i');

                if ($horaEntrada > $horaSalida) {
                    $context->buildViolation('La hora de salida debe ser mayor a la hora de entrada')
                        ->atPath('horaSalida')
                        ->addViolation()
                    ;
                }

                if ($horaSalida < $horaMin || $horaSalida > $horaMax) {
                    $context->buildViolation('La hora debería estar entre las 6am y 10pm.')
                        ->atPath('horaSalida')
                        ->addViolation()
                    ;
                }
            }
        }
    }
}
