<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TrasladoRepository")
 */
class Traslado
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
     */
    private $usuarioRealiza;

    /**
     * @var Usuario
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Usuario")
     * @ORM\JoinColumn(name="usuario_recibe_id", referencedColumnName="id", nullable=false, unique=false)
     */
    private $usuarioRecibe;

    /**
     * @var Lugar
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Lugar")
     * @ORM\JoinColumn(name="lugar_destino_id", referencedColumnName="id", nullable=false, unique=false)
     */
    private $lugarDestino;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TrasladoElemento", mappedBy="traslado", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $trasladoElementos;

    /**
     * Traslado constructor.
     */
    public function __construct()
    {
        $this->trasladoElementos = new ArrayCollection();
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
     * @return Usuario
     */
    public function getUsuarioRecibe()
    {
        return $this->usuarioRecibe;
    }

    /**
     * @param Usuario $usuarioRecibe
     */
    public function setUsuarioRecibe($usuarioRecibe)
    {
        $this->usuarioRecibe = $usuarioRecibe;
    }

    /**
     * @return Lugar
     */
    public function getLugarDestino()
    {
        return $this->lugarDestino;
    }

    /**
     * @param Lugar $lugarDestino
     */
    public function setLugarDestino($lugarDestino)
    {
        $this->lugarDestino = $lugarDestino;
    }

    /**
     * @return mixed
     */
    public function getTrasladoElementos()
    {
        return $this->trasladoElementos;
    }

    /**
     * @param TrasladoElemento $elementoTraslado
     *
     * @return Traslado
     */
    public function addTrasladoElemento(TrasladoElemento $elementoTraslado)
    {
        $this->trasladoElementos[] = $elementoTraslado;
        $elementoTraslado->setTraslado($this);

        $elementoTraslado->getElemento()->setLugar($this->getLugarDestino());

        return $this;
    }

    /**
     * @param TrasladoElemento $elementoTraslado
     *
     * @return $this
     *
     * @internal param $elemento
     */
    public function removeTrasladoElemento($elementoTraslado)
    {
        $this->trasladoElementos->removeElement($elementoTraslado);

        return $this;
    }
}
