<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DocumentoRepository")
 * @Vich\Uploadable
 */
class Documento
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
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank()
     * @Assert\Length(max="100")
     */
    private $nombre;

    /**
     * @var TipoDocumento
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\TipoDocumento", inversedBy="documentos")
     * @ORM\JoinColumn(name="tipo_documento_id", referencedColumnName="id", nullable=false)
     */
    private $tipoDocumento;

    /**
     * @var Usuario
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Usuario")
     * @ORM\JoinColumn(name="usuario_sube_id", referencedColumnName="id", nullable=false)
     */
    private $usuarioSube;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $archivo;

    /**
     * @var File
     *
     * @Vich\UploadableField(mapping="documentos", fileNameProperty="archivo")}
     */
    private $archivoFile;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_subida", type="datetime")
     * @Assert\NotBlank()
     * @Assert\DateTime()
     */
    private $fechaSubida;

    /**
     * Documento constructor.
     */
    public function __construct()
    {
        $this->fechaSubida = new \DateTime();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getNombre();
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
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return string
     */
    public function getTipoDocumento()
    {
        return $this->tipoDocumento;
    }

    /**
     * @param string $tipoDocumento
     */
    public function setTipoDocumento($tipoDocumento)
    {
        $this->tipoDocumento = $tipoDocumento;
    }

    /**
     * @return Usuario
     */
    public function getUsuarioSube()
    {
        return $this->usuarioSube;
    }

    /**
     * @param Usuario $usuarioSube
     */
    public function setUsuarioSube($usuarioSube)
    {
        $this->usuarioSube = $usuarioSube;
    }

    /**
     * @return string
     */
    public function getArchivo()
    {
        return $this->archivo;
    }

    /**
     * @param string $archivo
     */
    public function setArchivo($archivo)
    {
        $this->archivo = $archivo;
    }

    /**
     * @return mixed
     */
    public function getArchivoFile()
    {
        return $this->archivoFile;
    }

    /**
     * @param File|null $archivo
     *
     * @internal param mixed $archivoFile
     */
    public function setArchivoFile(File $archivo = null)
    {
        $this->archivoFile = $archivo;

        if ($archivo) {
            $this->fechaSubida = new \DateTime();
        }
    }

    /**
     * @return \DateTime
     */
    public function getFechaSubida()
    {
        return $this->fechaSubida;
    }

    /**
     * @param \DateTime $fechaSubida
     */
    public function setFechaSubida($fechaSubida)
    {
        $this->fechaSubida = $fechaSubida;
    }
}
