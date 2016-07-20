<?php

namespace ConcejoBundle\Handler;

use Doctrine\Common\Persistence\ObjectManager;
use ConcejoBundle\HandlerInterface\RolHandlerInterface;
use ConcejoBundle\Model\RolInterface;


class RolHandler implements RolHandlerInterface {
    
    private $om;
    private $entityClass;
    private $repository;

    public function __construct(ObjectManager $om, $entityClass) {
        $this->om = $om;
        $this->entityClass = $entityClass;
        $this->repository = $this->om->getRepository($this->entityClass);
    }
    
    /**
     * Devuelve un rol.
     *
     * @param mixed $id
     *
     * @return RolInterface
     */
    public function get($id) {
        return $this->repository->find($id);
    }

    /**
     * Devuelve una lista de roles.
     *
     * @param int $limit  the limit of the result
     * @param int $offset starting from the offset
     *
     * @return array
     */
    public function all() {
        return $this->repository->findBy(array(), array('nombre'=>'ASC'));
    }

}
