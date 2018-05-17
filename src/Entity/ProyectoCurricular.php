<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProyectoCurricularRepository")
 * @DoctrineAssert\UniqueEntity("id")
 * @DoctrineAssert\UniqueEntity(fields={"nombre", "facultad"})
 */
class ProyectoCurricular
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(type="integer", unique=true)
     * @Assert\NotBlank()
     * @Assert\Range(min="0")
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
     * @var Facultad
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Facultad", inversedBy="proyectosCurriculares")
     * @ORM\JoinColumn(name="facultad_id", referencedColumnName="id", nullable=false)
     * @Assert\NotBlank()
     */
    private $facultad;

    public function __toString()
    {
        return $this->nombre;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
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
     * @return Facultad
     */
    public function getFacultad()
    {
        return $this->facultad;
    }

    /**
     * @param Facultad $facultad
     */
    public function setFacultad(Facultad $facultad)
    {
        $this->facultad = $facultad;
    }
}
