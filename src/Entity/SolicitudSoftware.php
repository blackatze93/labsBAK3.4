<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SolicitudSoftwareRepository")
 * @DoctrineAssert\UniqueEntity(fields={"nombre", "lugar"}, message="Ya existe una solicitud para esa sala.", errorPath="nombre" )
 */
class SolicitudSoftware
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
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(max="255")
     * @Assert\NotBlank()
     */
    private $nombre;

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
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param string $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
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
}
