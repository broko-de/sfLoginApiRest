<?php

namespace ConcejoBundle\HandlerInterface;

use ConcejoBundle\Model\UsuarioInterface;


interface UsuarioHandlerInterface {
    
    /**
     * Devuelve un usuario de acuerdo al identificador
     *
     * @api
     *
     * @param mixed $id
     *
     * @return UsuarioInterface
     */
    public function get($id);
    
    /**
     * Devuelve el usuario logeado en el sistema
     *
     * @api
     *
     *
     * @return UsuarioInterface
     */
    public function getUsuarioLogeado();
    
    /**
     * Devuelve la lista de usuarios.
     *
     * @param int $limit 
     * @param int $offset 
     *
     * @return array
     */
    public function all();
    
    /**
     * Crea un nuevo usuario.
     *
     * @api
     *
     * @param array $parameters
     *
     * @return UsuarioInterface
     */
    public function post(array $parameters);
    
    /**
     * Edita un usuario.
     *
     * @api
     *
     * @param UsuarioInterface   $usuario
     * @param array           $parameters
     *
     * @return UsuarioInterface
     */
    public function put(UsuarioInterface $usuario, array $parameters);

    /**
     * Actualiza parcialmente un usuario.
     *
     * @api
     *
     * @param UsuarioInterface   $usuario
     * @param array           $parameters
     *
     * @return UsuarioInterface
     */
    public function patch(UsuarioInterface $usuario, array $parameters);
    
    /**
     * Elimina un usuario.
     *
     * @api
     *
     * @param UsuarioInterface $usuario
     *
     * @return UsuarioInterface
     */
    public function delete(UsuarioInterface $usuario);
}
