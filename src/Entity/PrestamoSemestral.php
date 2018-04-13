<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PrestamoSemestralRepository")
 * @DoctrineAssert\UniqueEntity(fields={"lugar", "fecha", "horaInicio", "horaFin"}, repositoryMethod="findRangoPrestamoSemestral",
 *     message="Ya existe un horario asociado a esa fecha y lugar.")
 */
class PrestamoSemestral
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
     * @var string
     *
     * @ORM\Column(name="dia_clase", type="string", length=45)
     * @Assert\NotBlank()
     * @Assert\Length(max="45")
     */
    private $diaClase;

    /**
     * @var Asignatura
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Asignatura")
     * @ORM\JoinColumn(name="asignatura_id", referencedColumnName="id", nullable=false, unique=false)
     * @Assert\NotBlank()
     */
    private $asignatura;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     * @Assert\Range(min="0")
     */
    private $grupo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_inicio", type="date")
     * @Assert\NotBlank()
     * @Assert\Date()
     */
    private $fechaInicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_fin", type="date")
     * @Assert\NotBlank()
     * @Assert\Date()
     */
    private $fechaFin;

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
     * @Assert\NotBlank()
     */
    private $usuarioRegistra;

    /**
     * @var ProyectoCurricular
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\ProyectoCurricular")
     * @ORM\JoinColumn(name="proyecto_curricular_id", referencedColumnName="id", nullable=false)
     */
    private $proyectoCurricular;

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
     * @return string
     */
    public function getDiaClase()
    {
        return $this->diaClase;
    }

    /**
     * @param string $diaClase
     */
    public function setDiaClase($diaClase)
    {
        $this->diaClase = $diaClase;
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
     * @return int
     */
    public function getGrupo()
    {
        return $this->grupo;
    }

    /**
     * @param int $grupo
     */
    public function setGrupo($grupo)
    {
        $this->grupo = $grupo;
    }

    /**
     * @return \DateTime
     */
    public function getFechaInicio()
    {
        return $this->fechaInicio;
    }

    /**
     * @param \DateTime $fechaInicio
     */
    public function setFechaInicio($fechaInicio)
    {
        $this->fechaInicio = $fechaInicio;
    }

    /**
     * @return \DateTime
     */
    public function getFechaFin()
    {
        return $this->fechaFin;
    }

    /**
     * @param \DateTime $fechaFin
     */
    public function setFechaFin($fechaFin)
    {
        $this->fechaFin = $fechaFin;
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
     * @return ProyectoCurricular
     */
    public function getProyectoCurricular()
    {
        return $this->proyectoCurricular;
    }

    /**
     * @param ProyectoCurricular $proyectoCurricular
     */
    public function setProyectoCurricular($proyectoCurricular)
    {
        $this->proyectoCurricular = $proyectoCurricular;
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
