<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UsuarioRepository")
 * @ORM\Table(name="usuario")
 * @DoctrineAssert\UniqueEntity("documento")
 * @DoctrineAssert\UniqueEntity("codigo")
 */
class Usuario implements AdvancedUserInterface
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
     * @ORM\Column(type="string", length=5)
     * @Assert\NotBlank()
     * @Assert\Length(max="5")
     */
    private $tipoDocumento;

    /**
     * @var string
     *
     * @ORM\Column(type="string", unique=true, length=20)
     * @Assert\NotBlank()
     * @Assert\Range(min="0")
     * @Assert\Length(max="20")
     */
    private $documento;

    /**
     * @var string
     *
     * @ORM\Column(type="string", unique=true, length=20)
     * @Assert\NotBlank()
     * @Assert\Range(min="0")
     * @Assert\Length(max="20")
     */
    private $codigo;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank()
     * @Assert\Length(max="100")
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank()
     * @Assert\Length(max="100")
     */
    private $apellido;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100)
     * @Assert\Email()
     * @Assert\NotBlank()
     * @Assert\Length(max="100")
     */
    private $email;

    /**
     * @var string
     *
     * @Assert\Length(min = 6, max = 100)
     * @Assert\NotBlank(groups={"Registro"})
     */
    private $passwordEnClaro;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank()
     * @Assert\Length(max="100")
     */
    private $rol;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\Length(max="100")
     */
    private $cargo;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     * @Assert\Type(type="bool")
     */
    private $activo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank()
     * @Assert\DateTime()
     */
    private $fechaCreacion;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100)
     * @Assert\Length(max="100")
     */
    private $estado;

    /**
     * @var Dependencia
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Dependencia")
     * @ORM\JoinColumn(name="dependencia_id", referencedColumnName="id", nullable=true)
     */
    private $dependencia;

    /**
     * @var ProyectoCurricular
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\ProyectoCurricular")
     * @ORM\JoinColumn(name="proyecto_curricular_id", referencedColumnName="id", nullable=true)
     */
    private $proyectoCurricular;

    /**
     * Usuario constructor.
     */
    public function __construct()
    {
        $this->fechaCreacion = new \DateTime();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->nombre . ' ' . $this->apellido;
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
    public function getTipoDocumento()
    {
        return $this->tipoDocumento;
    }

    /**
     * @param string $tipoDocumento
     */
    public function setTipoDocumento(string $tipoDocumento)
    {
        $this->tipoDocumento = $tipoDocumento;
    }

    /**
     * @return string
     */
    public function getDocumento()
    {
        return $this->documento;
    }

    /**
     * @param string $documento
     */
    public function setDocumento(string $documento)
    {
        $this->documento = $documento;
    }

    /**
     * @return string
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * @param string $codigo
     */
    public function setCodigo(string $codigo)
    {
        $this->codigo = $codigo;
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
        $this->nombre = mb_convert_case($nombre, MB_CASE_TITLE, 'UTF-8');
    }

    /**
     * @return string
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * @param string $apellido
     */
    public function setApellido(string $apellido)
    {
        $this->apellido = mb_convert_case($apellido, MB_CASE_TITLE, 'UTF-8');
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email)
    {
        $this->email = mb_convert_case($email, MB_CASE_LOWER, 'UTF-8');
    }

    /**
     * @return string
     */
    public function getPasswordEnClaro()
    {
        return $this->passwordEnClaro;
    }

    /**
     * @param string $passwordEnClaro
     */
    public function setPasswordEnClaro(string $passwordEnClaro)
    {
        $this->passwordEnClaro = $passwordEnClaro;
    }

    /**
     * Returns the password used to authenticate the user.
     *
     * This should be the encoded password. On authentication, a plain-text
     * password will be salted, encoded, and then compared to this value.
     *
     * @return string The password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getRol()
    {
        return $this->rol;
    }

    /**
     * @param string $rol
     */
    public function setRol(string $rol)
    {
        $this->rol = $rol;
    }

    /**
     * @return string
     */
    public function getCargo()
    {
        return $this->cargo;
    }

    /**
     * @param string $cargo
     */
    public function setCargo(string $cargo)
    {
        $this->cargo = $cargo;
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
    public function setActivo(bool $activo)
    {
        $this->activo = $activo;
    }

    /**
     * @return \DateTime
     */
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }

    /**
     * @param \DateTime $fechaCreacion
     */
    public function setFechaCreacion(\DateTime $fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;
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
    public function setEstado(string $estado)
    {
        $this->estado = $estado;
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
     * @return ProyectoCurricular
     */
    public function getProyectoCurricular()
    {
        return $this->proyectoCurricular;
    }

    /**
     * @param ProyectoCurricular $proyectoCurricular
     */
    public function setProyectoCurricular(ProyectoCurricular $proyectoCurricular)
    {
        $this->proyectoCurricular = $proyectoCurricular;
    }

    /**
     * Checks whether the user's account has expired.
     *
     * Internally, if this method returns false, the authentication system
     * will throw an AccountExpiredException and prevent login.
     *
     * @return bool true if the user's account is non expired, false otherwise
     *
     * @see AccountExpiredException
     */
    public function isAccountNonExpired()
    {
        return true;
    }

    /**
     * Checks whether the user is locked.
     *
     * Internally, if this method returns false, the authentication system
     * will throw a LockedException and prevent login.
     *
     * @return bool true if the user is not locked, false otherwise
     *
     * @see LockedException
     */
    public function isAccountNonLocked()
    {
        return true;
    }

    /**
     * Checks whether the user's credentials (password) has expired.
     *
     * Internally, if this method returns false, the authentication system
     * will throw a CredentialsExpiredException and prevent login.
     *
     * @return bool true if the user's credentials are non expired, false otherwise
     *
     * @see CredentialsExpiredException
     */
    public function isCredentialsNonExpired()
    {
        return true;
    }

    /**
     * Checks whether the user is enabled.
     *
     * Internally, if this method returns false, the authentication system
     * will throw a DisabledException and prevent login.
     *
     * @return bool true if the user is enabled, false otherwise
     *
     * @see DisabledException
     */
    public function isEnabled()
    {
        return $this->activo;
    }

    /**
     * Returns the roles granted to the user.
     *
     * <code>
     * public function getRoles()
     * {
     *     return array('ROLE_USER');
     * }
     * </code>
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return (Role|string)[] The user roles
     */
    public function getRoles()
    {
        return array($this->rol);
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        return ;
    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername()
    {
        return $this->documento;
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        $this->passwordEnClaro = null;
    }

    /**
     * @Assert\Callback
     *
     * @param ExecutionContextInterface $context
     */
    public function validarDependencia(ExecutionContextInterface $context)
    {
        if (is_null($this->dependencia) && is_null($this->proyectoCurricular)) {
            $context->buildViolation('Debe asignar una dependencia o proyecto curricular al usuario.')
                ->atPath('dependencia')
                ->addViolation()
            ;
        } elseif (!is_null($this->dependencia) && !is_null($this->proyectoCurricular)) {
            $context->buildViolation('No puede asignar una dependencia y proyecto curricular a un usuario al mismo tiempo.')
                ->atPath('proyectoCurricular')
                ->addViolation();
        }
    }
}
