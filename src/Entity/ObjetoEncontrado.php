<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ObjetoEncontradoRepository")
 */
class ObjetoEncontrado
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
    private $descripcion;

    /**
     * @var Lugar
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Lugar")
     * @ORM\JoinColumn(name="lugar_id", referencedColumnName="id", nullable=false, unique=false)
     * @Assert\NotBlank()
     */
    private $lugar;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank()
     * @Assert\DateTime()
     */
    private $fechaRegistro;

    /**
     * @var Usuario
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Usuario")
     * @ORM\JoinColumn(name="usuario_registra_id", referencedColumnName="id", nullable=false)
     */
    private $usuarioRegistra;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     * @Assert\Type(type="bool")
     */
    private $entregado;

    /**
     * @var Usuario
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Usuario")
     * @ORM\JoinColumn(name="usuario_reclama_id", referencedColumnName="id", nullable=true)
     */
    private $usuarioReclama;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     * @Assert\DateTime()
     */
    private $fechaEntrega;

    /**
     * @var Usuario
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Usuario")
     * @ORM\JoinColumn(name="usuario_entrega_id", referencedColumnName="id", nullable=true)
     */
    private $usuarioEntrega;

    /**
     * ObjetoEncontrado constructor.
     */
    public function __construct()
    {
        $this->fechaRegistro = new \DateTime();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getDescripcion();
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
     * @return bool
     */
    public function isEntregado()
    {
        return $this->entregado;
    }

    /**
     * @param bool $entregado
     */
    public function setEntregado($entregado)
    {
        $this->entregado = $entregado;
    }

    /**
     * @return Usuario
     */
    public function getUsuarioReclama()
    {
        return $this->usuarioReclama;
    }

    /**
     * @param Usuario $usuarioReclama
     */
    public function setUsuarioReclama($usuarioReclama)
    {
        $this->usuarioReclama = $usuarioReclama;
    }

    /**
     * @return \DateTime
     */
    public function getFechaEntrega()
    {
        return $this->fechaEntrega;
    }

    /**
     * @param \DateTime $fechaEntrega
     */
    public function setFechaEntrega($fechaEntrega)
    {
        $this->fechaEntrega = $fechaEntrega;
    }

    /**
     * @return Usuario
     */
    public function getUsuarioEntrega()
    {
        return $this->usuarioEntrega;
    }

    /**
     * @param Usuario $usuarioEntrega
     */
    public function setUsuarioEntrega($usuarioEntrega)
    {
        $this->usuarioEntrega = $usuarioEntrega;
    }
}
