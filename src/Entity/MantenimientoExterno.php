<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MantenimientoExternoRepository")
 */
class MantenimientoExterno
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
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank()
     * @Assert\Length(max="100")
     */
    private $nombreEmpresa;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank()
     * @Assert\Length(max="100")
     */
    private $nombreTecnico;

    /**
     * @var int
     *
     * @ORM\Column(type="string", length=20)
     * @Assert\NotBlank()
     * @Assert\Range(min="0")
     * @Assert\Length(max="20")
     */
    private $cedulaTecnico;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank()
     * @Assert\DateTime()
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     */
    private $descripcion;

    /**
     * @var Usuario
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Usuario")
     * @ORM\JoinColumn(name="usuario_atiende_id", referencedColumnName="id", nullable=false)
     * @Assert\NotBlank()
     */
    private $usuarioAtiende;

    /**
     * MantenimientoExterno constructor.
     */
    public function __construct()
    {
        $this->fecha = new \DateTime();
    }

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
    public function getNombreEmpresa()
    {
        return $this->nombreEmpresa;
    }

    /**
     * @param string $nombreEmpresa
     */
    public function setNombreEmpresa($nombreEmpresa)
    {
        $this->nombreEmpresa = $nombreEmpresa;
    }

    /**
     * @return string
     */
    public function getNombreTecnico()
    {
        return $this->nombreTecnico;
    }

    /**
     * @param string $nombreTecnico
     */
    public function setNombreTecnico($nombreTecnico)
    {
        $this->nombreTecnico = $nombreTecnico;
    }

    /**
     * @return int
     */
    public function getCedulaTecnico()
    {
        return $this->cedulaTecnico;
    }

    /**
     * @param int $cedulaTecnico
     */
    public function setCedulaTecnico($cedulaTecnico)
    {
        $this->cedulaTecnico = $cedulaTecnico;
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
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * @param string $descripcion
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
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
}
