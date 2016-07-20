<?php

namespace ConcejoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use ConcejoBundle\Entity\Rol;
use ConcejoBundle\Model\UsuarioInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;

/**
 * Usuarios
 *
 * @ORM\Table(name="usuarios")
 * @ORM\Entity(repositoryClass="ConcejoBundle\Repository\UsuarioRepository")
 * @ExclusionPolicy("all") 
 */
class Usuario implements UserInterface, UsuarioInterface {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Expose
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=80)
     * @Assert\NotBlank(message = "Por favor, ingrese Nombre")
     * @Assert\Length(
     *      min = 3,
     *      max = 80,     
     *      minMessage = "El nombre por lo menos debe tener {{ limit }} caracteres",
     *      maxMessage = "El nombre no debe tener mas de {{ limit }} caracteres"
     * )
     * @Expose
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="apellido", type="string", length=60)
     * @Assert\NotBlank(message = "Por favor, ingrese Apellido")
     * @Assert\Length(
     *      min = 3,
     *      max = 60,     
     *      minMessage = "El apellido por lo menos debe tener {{ limit }} caracteres",
     *      maxMessage = "El apellido no debe tener mas de {{ limit }} caracteres"
     * )
     * @Expose
     */
    private $apellido;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=150, nullable=true)
     * @Assert\Length(
     *      max = 150,     
     *      maxMessage = "El email no debe tener mas de {{ limit }} caracteres"
     * )
     * @Assert\Email(
     *     message = "El email'{{ value }}' no es un email válido.",
     *     checkMX = true
     * )
     * @Expose
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="dni", type="string", length=9)
     * @Assert\NotBlank(message = "Por favor, ingrese Dni")
     * @Assert\Length(
     *      min = 6,
     *      max = 9,     
     *      minMessage = "El dni por lo menos debe tener {{ limit }} caracteres",
     *      maxMessage = "El dni no debe tener mas de {{ limit }} caracteres"
     * )
     * @Assert\Type(
     *     type="integer",
     *     message="El dni {{ value }} no es un {{ type }} válido."
     * )
     * @Expose
     */
    private $dni;

    /**
     * @var string
     *
     * @ORM\Column(name="domicilio", type="string", length=150)
     * @Assert\NotBlank(message = "Por favor, ingrese Domicilio")
     * @Assert\Length(
     *      max = 150,     
     *      maxMessage = "El domicilio no debe tener mas de {{ limit }} caracteres"
     * )
     * @Expose
     */
    private $domicilio;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string", length=255)
     * 
     */
    private $salt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_creacion", type="datetime")
     * @Expose
     * 
     */
    private $fechaCreacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_modificacion", type="datetime", nullable=true)
     * @Expose
     * 
     */
    private $fechaModificacion;

    /**
     * @ORM\ManyToMany(targetEntity="Rol")
     * @ORM\JoinTable(name="usuarios_roles",
     *      joinColumns={@ORM\JoinColumn(name="usuario_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="rol_id", referencedColumnName="id")}
     * )
     * @Assert\NotNull(message="Debe especificar un rol.")
     * @Expose
     * 
     */
    private $usuarioRoles;

    public function __construct() {
        $this->usuarioRoles = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Usuarios
     */
    public function setNombre($nombre) {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre() {
        return $this->nombre;
    }

    /**
     * Set apellido
     *
     * @param string $apellido
     * @return Usuarios
     */
    public function setApellido($apellido) {
        $this->apellido = $apellido;

        return $this;
    }

    /**
     * Get apellido
     *
     * @return string 
     */
    public function getApellido() {
        return $this->apellido;
    }

    /**
     * Set usuario
     *
     * @param string $usuario
     * @return Usuarios
     */
    public function setUsuario($usuario) {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return string 
     */
    public function getUsuario() {
        return $this->usuario;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Usuarios
     */
    public function setPassword($password) {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * Set salt
     *
     * @param string $salt
     * @return Usuario
     */
    public function setSalt($salt) {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Get salt
     *
     * @return string 
     */
    public function getSalt() {
        return $this->salt;
    }

    /**
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     * @return Usuarios
     */
    public function setFechaCreacion($fechaCreacion) {
        $this->fechaCreacion = $fechaCreacion;

        return $this;
    }

    /**
     * Get fechaCreacion
     *
     * @return \DateTime 
     */
    public function getFechaCreacion() {
        return $this->fechaCreacion;
    }

    /**
     * Set fechaModificacion
     *
     * @param \DateTime $fechaModificacion
     * @return Usuarios
     */
    public function setFechaModificacion($fechaModificacion) {
        $this->fechaModificacion = $fechaModificacion;

        return $this;
    }

    /**
     * Get fechaModificacion
     *
     * @return \DateTime 
     */
    public function getFechaModificacion() {
        return $this->fechaModificacion;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername() {
        return $this->dni;
    }

    /**
     * Add usuariosRoles
     *
     * @param Rol $userRoles
     */
    public function addRole(Rol $userRoles) {
        $this->usuarioRoles[] = $userRoles;
    }

    public function setUsuarioRoles($roles) {
        $this->usuarioRoles = $roles;
    }

    /**
     * Get usuariosRoles
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getUsuarioRoles() {
        return $this->usuarioRoles;
    }

    /**
     * Get roles
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getRoles() {
        $roles = array();
        foreach ($this->usuarioRoles as $role) {
            $roles[] = $role->getRole();
        }
        return $roles; //IMPORTANTE: el mecanismo de seguridad de Sf2 requiere ésto como un array
    }

    /**
     * Compares this user to another to determine if they are the same.
     *
     * @param UserInterface $user The user
     * @return boolean True if equal, false othwerwise.
     */
    public function equals(UserInterface $user) {
        return md5($this->getUsername()) == md5($user->getUsername());
    }

    /**
     * Erases the user credentials.
     */
    public function eraseCredentials() {
        
    }
    
    public function getEmail() {
        return $this->email;
    }

    public function getDni() {
        return $this->dni;
    }

    public function getDomicilio() {
        return $this->domicilio;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setDni($dni) {
        $this->dni = $dni;
    }

    public function setDomicilio($domicilio) {
        $this->domicilio = $domicilio;
    }

}
