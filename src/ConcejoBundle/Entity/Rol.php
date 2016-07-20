<?php

namespace ConcejoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use ConcejoBundle\Model\RolInterface;
use Symfony\Component\Security\Core\Role\RoleInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Roles
 *
 * @ORM\Table(name="roles")
 * @ORM\Entity(repositoryClass="ConcejoBundle\Repository\RolRepository")
 */
class Rol implements RolInterface, RoleInterface {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=45)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_alternativo", type="string", length=45)
     */
    private $nombreAlternativo;


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
     * @return Roles
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
    public function getNombreAlternativo() {
        return $this->nombreAlternativo;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Roles
     */
    public function setNombreAlternativo($nombreAlternativo) {
        $this->nombreAlternativo = $nombreAlternativo;

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

    public function getRole() {
        return $this->getNombre();
    }

    public function __toString() {
        return $this->getRole();
    }

}
