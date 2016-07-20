<?php

namespace ConcejoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Util\Codes;
use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Request\ParamFetcherInterface;
use FOS\RestBundle\Controller\Annotations\Get;

/**
 * Class RolController
 */
class RolController extends FOSRestController{
	
    /**
     * Lista todos los roles.
     *
     * @Get("/roles")
     * @param Request               $request      the request object
     * @param ParamFetcherInterface $paramFetcher param fetcher service
     *
     * @return array
     */
    public function getRolesAction(Request $request, ParamFetcherInterface $paramFetcher)
    {
        return $this->container->get('cilo_denuncias.rol.handler')->all();
    }
    
    /**
     * Devuelve un rol.
     *
     * @param int     $id      rol id
     *
     * @return array
     *
     * @throws NotFoundHttpException when tag not exist
     */
    public function getRolAction($id)
    {
        $rol = $this->getOr404($id);
        return $rol;
    }
    
    
    /**
     * Devuelve el rol o un 404 Exception.
     *
     * @param mixed $id
     *
     * @return RolInterface
     *
     * @throws NotFoundHttpException
     */
    protected function getOr404($id)
    {
        if (!($rol = $this->container->get('concejo.rol.handler')->get($id))) {
            throw new NotFoundHttpException(sprintf('El elemento \'%s\' no se encontró.',$id));
        }
        return $rol;
    }	

}
