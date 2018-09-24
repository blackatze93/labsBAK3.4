<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ElementoRepository")
 * @DoctrineAssert\UniqueEntity("placa")
 * @DoctrineAssert\UniqueEntity("serial")
 * @Vich\Uploadable
 */
class Elemento
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
     * @ORM\Column(type="string", length=100, nullable=true, unique=true)
     * @Assert\Length(max="100")
     */
    private $placa;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\Length(max="100")
     */
    private $modelo;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\Length(max="100")
     */
    private $marca;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=1000, nullable=true)
     * @Assert\Length(max="1000")
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100, nullable=true, unique=true)
     * @Assert\Length(max="100")
     */
    private $serial;

    /**
     * @var Lugar
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Lugar", inversedBy="elementos")
     * @ORM\JoinColumn(name="lugar_id", referencedColumnName="id", nullable=false, unique=false)
     * @Assert\NotBlank()
     */
    private $lugar;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="date", nullable=true)
     * @Assert\Date()
     */
    private $fechaIngreso;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=45, nullable=true)
     * @Assert\Length(max="45")
     */
    private $estado;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=45, nullable=true)
     * @Assert\Length(max="45")
     */
    private $tipo;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=45, nullable=false)
     * @Assert\Length(max="45")
     */
    private $tipoPrestamo;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $observaciones;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     * @Assert\Type(type="bool")
     */
    private $prestado;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     * @Assert\Type(type="bool")
     */
    private $activo;

    /**
     * @var Equipo
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Equipo", inversedBy="elementos")
     * @ORM\JoinColumn(name="equipo_id", referencedColumnName="id", nullable=true)
     */
    private $equipo;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imagen;

    /**
     * @var File
     *
     * @Vich\UploadableField(mapping="imagenes_elementos", fileNameProperty="imagen")
     */
    private $imagenFile;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_actualizacion", type="datetime")
     * @Assert\NotBlank()
     * @Assert\DateTime()
     */
    private $fechaActualizacion;

    /**
     * Elemento constructor.
     */
    public function __construct()
    {
        $this->setActivo(true);
        $this->setPrestado(false);
        $this->setTipoPrestamo('Nadie');
        $this->setEstado('Bueno');
        $this->setFechaActualizacion(new \DateTime());
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return 'Nombre: '.$this->getNombre().', Placa: '.$this->getPlaca();
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
    public function getPlaca()
    {
        return $this->placa;
    }

    /**
     * @param string $placa
     */
    public function setPlaca($placa)
    {
        $this->placa = $placa;
    }

    /**
     * @return string
     */
    public function getModelo()
    {
        return $this->modelo;
    }

    /**
     * @param string $modelo
     */
    public function setModelo($modelo)
    {
        $this->modelo = $modelo;
    }

    /**
     * @return string
     */
    public function getMarca()
    {
        return $this->marca;
    }

    /**
     * @param string $marca
     */
    public function setMarca($marca)
    {
        $this->marca = $marca;
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
    public function getSerial()
    {
        return $this->serial;
    }

    /**
     * @param string $serial
     */
    public function setSerial($serial)
    {
        $this->serial = $serial;
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
    public function getFechaIngreso()
    {
        return $this->fechaIngreso;
    }

    /**
     * @param \DateTime $fechaIngreso
     */
    public function setFechaIngreso($fechaIngreso)
    {
        $this->fechaIngreso = $fechaIngreso;
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
     * @return string
     */
    public function getTipoPrestamo()
    {
        return $this->tipoPrestamo;
    }

    /**
     * @param string $tipoPrestamo
     */
    public function setTipoPrestamo($tipoPrestamo)
    {
        $this->tipoPrestamo = $tipoPrestamo;
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
     * @return bool
     */
    public function isPrestado()
    {
        return $this->prestado;
    }

    /**
     * @param bool $prestado
     */
    public function setPrestado($prestado)
    {
        $this->prestado = $prestado;
    }

    /**
     * @return bool
     */
    public function isActivo()
    {
        return $this->activo;
    }

    /**
     * @param bool $activo
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;
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
     * @return File
     */
    public function getImagenFile()
    {
        return $this->imagenFile;
    }

    /**
     * @param File|null $imagen
     */
    public function setImagenFile(File $imagen = null)
    {
        $this->imagenFile = $imagen;

        if ($imagen) {
            $this->setFechaActualizacion(new \DateTime());
        }
    }

    /**
     * @return string
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * @param string $imagen
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;
    }

    /**
     * @return \DateTime
     */
    public function getFechaActualizacion()
    {
        return $this->fechaActualizacion;
    }

    /**
     * @param \DateTime $fechaActualizacion
     */
    public function setFechaActualizacion($fechaActualizacion)
    {
        $this->fechaActualizacion = $fechaActualizacion;
    }




}
