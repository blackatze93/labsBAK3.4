<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FacultadRepository")
 * @DoctrineAssert\UniqueEntity("nombre")
 */
class Facultad
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank()
     * @Assert\Length(max="100")
     */
    private $nombre;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Dependencia", mappedBy="facultad")
     */
    private $dependencias;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ProyectoCurricular", mappedBy="facultad")
     */
    private $proyectosCurriculares;

    public function __toString()
    {
        return $this->nombre;
    }

    public function __construct()
    {
        $this->dependencias = new ArrayCollection();
        $this->proyectosCurriculares = new ArrayCollection();
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
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param string $nombre
     */
    public function setNombre(string $nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getDependencias()
    {
        return $this->dependencias;
    }

    /**
     * @return mixed
     */
    public function getProyectosCurriculares()
    {
        return $this->proyectosCurriculares;
    }

}
