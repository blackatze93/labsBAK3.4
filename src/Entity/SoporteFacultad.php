<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SoporteFacultadRepository")
 */
class SoporteFacultad
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
     * @var Dependencia
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Dependencia")
     * @ORM\JoinColumn(name="dependencia_id", referencedColumnName="id", nullable=true)
     * @Assert\NotBlank()
     */
    private $dependencia;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     */
    private $descripcionProblema;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
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
     * SoporteFacultad constructor.
     */
    public function __construct()
    {
        $this->fechaRegistro = new \DateTime();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Dependencia
     */
    public function getDependencia()
    {
        return $this->dependencia;
    }

    /**
     * @param Dependencia $dependencia
     */
    public function setDependencia(Dependencia $dependencia)
    {
        $this->dependencia = $dependencia;
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
    public function setDescripcionProblema(string $descripcionProblema)
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
    public function setFechaRegistro(\DateTime $fechaRegistro)
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
    public function setUsuarioRegistra(Usuario $usuarioRegistra)
    {
        $this->usuarioRegistra = $usuarioRegistra;
    }
}
