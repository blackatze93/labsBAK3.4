<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BajaRepository")
 */
class Baja
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
     * @var \DateTime
     *
     * @ORM\Column(type="date")
     * @Assert\NotBlank()
     * @Assert\Date()
     */
    private $fecha;

    /**
     * @var Usuario
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Usuario")
     * @ORM\JoinColumn(name="usuario_realiza_id", referencedColumnName="id", nullable=false, unique=false)
     * @Assert\NotBlank()
     */
    private $usuarioRealiza;

    /**
     * @var int
     *
     * @ORM\Column(type="bigint")
     * @Assert\NotBlank()
     * @Assert\Range(min="0")
     */
    private $cedulaRecibe;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank()
     * @Assert\Length(max="100")
     */
    private $nombreRecibe;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\BajaElemento", mappedBy="baja", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $bajaElementos;

    /**
     * Baja constructor.
     */
    public function __construct()
    {
        $this->bajaElementos = new ArrayCollection();
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
     * @return string
     */
    public function getCedulaRecibe()
    {
        return $this->cedulaRecibe;
    }

    /**
     * @param string $cedulaRecibe
     */
    public function setCedulaRecibe($cedulaRecibe)
    {
        $this->cedulaRecibe = $cedulaRecibe;
    }

    /**
     * @return string
     */
    public function getNombreRecibe()
    {
        return $this->nombreRecibe;
    }

    /**
     * @param string $nombreRecibe
     */
    public function setNombreRecibe($nombreRecibe)
    {
        $this->nombreRecibe = $nombreRecibe;
    }

    /**
     * @return mixed
     */
    public function getBajaElementos()
    {
        return $this->bajaElementos;
    }

    /**
     * @param BajaElemento $elementoBaja
     *
     * @return Baja
     */
    public function addBajaElemento(BajaElemento $elementoBaja)
    {
        $this->bajaElementos[] = $elementoBaja;
        $elementoBaja->setBaja($this);

        $elementoBaja->getElemento()->setActivo(false);

        return $this;
    }

    /**
     * @param BajaElemento $elementoBaja
     *
     * @return $this
     *
     * @internal param $elemento
     */
    public function removeBajaElemento($elementoBaja)
    {
        $elementoBaja->getElemento()->setActivo(true);

        $this->bajaElementos->removeElement($elementoBaja);

        return $this;
    }
}
