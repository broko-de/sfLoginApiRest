<?php

namespace ConcejoBundle\HandlerInterface;

interface RolHandlerInterface {
    
    /**
     * Devuelve un rol de acuerdo al identificador
     *
     * @api
     *
     * @param mixed $id
     *
     * @return RolInterface
     */
    public function get($id);
    
    /**
     * Devuelve la lista de roles.
     *
     * @param int $limit 
     * @param int $offset 
     *
     * @return array
     */
    public function all();
    
}
