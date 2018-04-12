<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PrestamoElementoRepository")
 */
class PrestamoElemento
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
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank()
     * @Assert\DateTime()
     */
    private $fechaPrestamo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     * @Assert\DateTime()
     */
    private $fechaDevolucion;

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
     * @var Elemento
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Elemento")
     * @ORM\JoinColumn(name="elemento_id", referencedColumnName="id", nullable=false, unique=false)
     * @Assert\NotBlank()
     */
    private $elemento;

    /**
     * @var Usuario
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Usuario")
     * @ORM\JoinColumn(name="usuario_realiza_id", referencedColumnName="id", nullable=false, unique=false)
     */
    private $usuarioRealiza;

    /**
     * PrestamoElemento constructor.
     */
    public function __construct()
    {
        $this->fechaPrestamo = new \DateTime();
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
    public function getFechaDevolucion()
    {
        return $this->fechaDevolucion;
    }

    /**
     * @param \DateTime $fechaDevolucion
     */
    public function setFechaDevolucion($fechaDevolucion)
    {
        $this->fechaDevolucion = $fechaDevolucion;
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

    /*
     * @Assert\Callback
     *
     * @param ExecutionContextInterface $context
     */
//    public function validarUsuario(ExecutionContextInterface $context)
//    {
//        if (is_null($this->estudiante) && is_null($this->usuario)){
//            $context->buildViolation('Debe asignar un estudiante o usuario al prestamo.')
//                ->atPath('estudiante')
//                ->addViolation()
//            ;
//        } elseif (!is_null($this->estudiante) && !is_null($this->usuario)) {
//            $context->buildViolation('No puede asignar un prestamo a un estudiante y un usuario al mismo tiempo.')
//                ->atPath('usuario')
//                ->addViolation();
//        }
//    }
}
