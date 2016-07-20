<?php

namespace ConcejoBundle\Model;


interface UsuarioInterface {
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId();

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Usuarios
     */
    public function setNombre($nombre);

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre();

    /**
     * Set apellido
     *
     * @param string $apellido
     * @return Usuarios
     */
    public function setApellido($apellido);

    /**
     * Get apellido
     *
     * @return string 
     */
    public function getApellido();

    /**
     * Set usuario
     *
     * @param string $usuario
     * @return Usuarios
     */
    public function setUsuario($usuario);

    /**
     * Get usuario
     *
     * @return string 
     */
    public function getUsuario();


    /**
     * Set password
     *
     * @param string $password
     * @return Usuarios
     */
    public function setPassword($password);

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword();

    /**
     * Set salt
     *
     * @param string $salt
     * @return Usuario
     */
    public function setSalt($salt);

    /**
     * Get salt
     *
     * @return string 
     */
    public function getSalt();
    
    /**
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     * @return Usuarios
     */
    public function setFechaCreacion($fechaCreacion);

    /**
     * Get fechaCreacion
     *
     * @return \DateTime 
     */
    public function getFechaCreacion();
    
    /**
     * Set fechaModificacion
     *
     * @param \DateTime $fechaModificacion
     * @return Usuarios
     */
    public function setFechaModificacion($fechaModificacion);

    /**
     * Get fechaModificacion
     *
     * @return \DateTime 
     */
    public function getFechaModificacion();
    
    public function getEmail();

    public function getDni();

    public function getDomicilio();

    public function setEmail($email);
    
    public function setDni($dni);

    public function setDomicilio($domicilio);
    
}
