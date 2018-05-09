<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\IncidenciaRepository")
 */
class Incidencia
{
    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     */
    private $descripcionProblema;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $descripcionSolucion;

    /**
     * @var Elemento
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Elemento")
     * @ORM\JoinColumn(name="elemento_id", referencedColumnName="id", nullable=true, unique=false)
     */
    private $elemento;

    /**
     * @var Equipo
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Equipo")
     * @ORM\JoinColumn(name="equipo_id", referencedColumnName="id", nullable=true, unique=false)
     */
    private $equipo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     * @Assert\DateTime()
     */
    private $fechaRegistro;

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
     * @ORM\Column(type="datetime", nullable=true)
     * @Assert\DateTime()
     */
    private $fechaAtencion;

    /**
     * @var Usuario
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Usuario")
     * @ORM\JoinColumn(name="usuario_registra_id", referencedColumnName="id", nullable=false)
     */
    private $usuarioRegistra;

    /**
     * @var Usuario
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Usuario")
     * @ORM\JoinColumn(name="usuario_atiende_id", referencedColumnName="id", nullable=true)
     */
    private $usuarioAtiende;

    /**
     * Incidencia constructor.
     */
    public function __construct()
    {
        $this->fechaRegistro = new \DateTime();
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getDescripcionProblema()
    {
        return $this->descripcionProblema;
    }

    /**
     * @param string $descripcionProblema
     */
    public function setDescripcionProblema($descripcionProblema)
    {
        $this->descripcionProblema = $descripcionProblema;
    }

    /**
     * @return \DateTime
     */
    public function getFechaRegistro()
    {
        return $this->fechaRegistro;
    }

    /**
     * @param \DateTime $fechaRegistro
     */
    public function setFechaRegistro($fechaRegistro)
    {
        $this->fechaRegistro = $fechaRegistro;
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
    public function getFechaAtencion()
    {
        return $this->fechaAtencion;
    }

    /**
     * @param \DateTime $fechaAtencion
     */
    public function setFechaAtencion($fechaAtencion)
    {
        $this->fechaAtencion = $fechaAtencion;
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
     * @return Usuario
     */
    public function getUsuarioAtiende()
    {
        return $this->usuarioAtiende;
    }

    /**
     * @param Usuario $usuarioAtiende
     */
    public function setUsuarioAtiende($usuarioAtiende)
    {
        $this->usuarioAtiende = $usuarioAtiende;
    }

    /**
     * @return string
     */
    public function getDescripcionSolucion()
    {
        return $this->descripcionSolucion;
    }

    /**
     * @param string $descripcionSolucion
     */
    public function setDescripcionSolucion($descripcionSolucion)
    {
        $this->descripcionSolucion = $descripcionSolucion;
    }

    /**
     * @return Elemento
     */
    public function getElemento()
    {
        return $this->elemento;
    }

    /**
     * @param Elemento $elemento
     */
    public function setElemento($elemento)
    {
        $this->elemento = $elemento;
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
}
