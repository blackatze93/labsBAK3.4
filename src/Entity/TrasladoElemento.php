<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TrasladoElementoRepository")
 */
class TrasladoElemento
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
     * @var Traslado
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Traslado", inversedBy="trasladoElementos")
     * @ORM\JoinColumn(name="traslado_id", referencedColumnName="id", nullable=false)
     */
    private $traslado;

    /**
     * @var Elemento
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Elemento")
     * @ORM\JoinColumn(name="elemento_id", referencedColumnName="id", nullable=false)
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
     * @return string
     */
    public function __toString()
    {
        return 'Elemento: '.$this->getElemento().', Observación: '.$this->getObservacion().'.';
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Traslado
     */
    public function getTraslado()
    {
        return $this->traslado;
    }

    /**
     * @param Traslado $traslado
     *
     * @return TrasladoElemento
     */
    public function setTraslado($traslado)
    {
        $this->traslado = $traslado;

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
}
