<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BajaElementoRepository")
 * @DoctrineAssert\UniqueEntity("elemento")
 */
class BajaElemento
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
     * @var Baja
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Baja", inversedBy="bajaElementos")
     * @ORM\JoinColumn(name="baja_id", referencedColumnName="id", nullable=false)
     */
    private $baja;

    /**
     * @var Elemento
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Elemento")
     * @ORM\JoinColumn(name="elemento_id", referencedColumnName="id", nullable=false, unique=true)
     * @Assert\NotBlank()
     */
    private $elemento;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max="255")
     */
    private $observacion;

    /**
     * @var MotivoBaja
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\MotivoBaja", inversedBy="bajas")
     * @ORM\JoinColumn(name="motivo_baja_id", referencedColumnName="id", nullable=false, unique=false)
     * @Assert\NotBlank()
     */
    private $motivoBaja;

    /**
     * @return string
     */
    public function __toString()
    {
        return 'Elemento: '.$this->getElemento().', Observación: '.$this->getObservacion().', Motivo de Baja: '.$this->getMotivoBaja().'.';
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Baja
     */
    public function getBaja()
    {
        return $this->baja;
    }

    /**
     * @param Baja $baja
     *
     * @return BajaElemento
     */
    public function setBaja(Baja $baja)
    {
        $this->baja = $baja;

        return $this;
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
     * @return string
     */
    public function getObservacion()
    {
        return $this->observacion;
    }

    /**
     * @param string $observacion
     */
    public function setObservacion($observacion)
    {
        $this->observacion = $observacion;
    }

    /**
     * @return MotivoBaja
     */
    public function getMotivoBaja()
    {
        return $this->motivoBaja;
    }

    /**
     * @param MotivoBaja $motivoBaja
     */
    public function setMotivoBaja($motivoBaja)
    {
        $this->motivoBaja = $motivoBaja;
    }
}
