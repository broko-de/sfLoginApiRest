<?php

namespace ConcejoBundle\Model;

interface RolInterface {
    
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
     * @return Roles
     */
    public function setNombre($nombre);

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre();
    
    /**
     * Set nombreAlternativo
     *
     * @param string $nombreAlternativo
     * @return Roles
     */
    public function setNombreAlternativo($nombreAlternativo);

    /**
     * Get nombreAlternativo
     *
     * @return string 
     */
    public function getNombreAlternativo();

    public function getRole();
}
