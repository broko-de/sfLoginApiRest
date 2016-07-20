<?php

namespace ConcejoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Util\Codes;
use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Request\ParamFetcherInterface;
use Symfony\Component\Form\FormTypeInterface;
use ConcejoBundle\Exception\InvalidFormException;
use ConcejoBundle\Form\UsuarioType;
use ConcejoBundle\Model\UsuarioInterface;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Put;
use FOS\RestBundle\Controller\Annotations\Patch;
use FOS\RestBundle\Controller\Annotations\Delete;

/**
 * Class UsuarioController
 */
class UsuarioController extends FOSRestController{
	
    /**
     * Lista todos los usuarios.
     * @Get("/api/usuarios")
     * @param Request               $request      the request object
     * @param ParamFetcherInterface $paramFetcher param fetcher service
     *
     * @return array
     */
    public function getUsuariosAction(Request $request, ParamFetcherInterface $paramFetcher)
    {
        return $this->container->get('concejo.usuario.handler')->all();
    }
    
    /**
     * Devuelve un usuario.  
     * 
     * @Get("/public/usuario/{id}")
     * 
     * @param int     $id      usuario id
     *
     * @return array
     *
     * @throws NotFoundHttpException when tag not exist
     */
    public function getUsuarioAction($id)
    {
        $usuario = $this->getOr404($id);
        return $usuario;
    }
    
    /**
     * Devuelve el usuario logeado.
     * @Get("/public/usuario/logeado")
     * 
     * @return array
     *
     * @throws NotFoundHttpException when tag not exist
     */
    public function getUsuarioLogeadoAction()
    {
        $usuario = $this->container->get('concejo.usuario.handler')->getUsuarioLogeado();
        $statusCode = Codes::HTTP_OK;
        $resposnse = array(
            'status' => 'Ok',
            'code' => $statusCode,
            'data' => $usuario
        );
        return $resposnse;
    }
      
    /**
     * Crea un nuevo usuario a partir del envio de datos desde un formulario.
     * @Post("/api/usuario")
     *
     * @param Request $request the request object
     *
     * @return FormTypeInterface|View
     */
    public function postUsuarioAction(Request $request)
    {
        try {
            $newUsuario = $this->container->get('concejo.usuario.handler')->post(
                $request->request->all()
            );
            $statusCode = Codes::HTTP_CREATED;
//            $routeOptions = array(
//                'id' => $newBarrio->getId(),
//                '_format' => $request->get('_format')
//            );
            $resposnse = array(
                'status' => 'Ok',
                'code' => $statusCode,
                'message' => 'Se creo el usuario exitosamente',
                'data' => $newUsuario
            );
            return $resposnse;
        } catch (InvalidFormException $exception) {
            return $exception->getForm();
        }
    }
    
    /**
     * Actualiza un usuario existente con los datos de un formulario, si no existe el usuario crea uno nuevo
     * @Put("/api/usuario/{id}")
     *
     * @param Request $request the request object
     * @param int     $id      barrui id
     *
     * @return FormTypeInterface|View
     *
     * @throws NotFoundHttpException when tag not exist
     */
    public function putUsuarioAction(Request $request, $id)
    {
        try {
            if (!($usuario = $this->container->get('concejo.usuario.handler')->get($id))) {
                $statusCode = Codes::HTTP_CREATED;
                $usuario = $this->container->get('concejo.usuario.handler')->post(
                    $request->request->all()
                );
                $msg = 'Se creo el usuario exitosamente.';
            } else {
                $statusCode = Codes::HTTP_OK;
                $msg = 'Se editó el usuario exitosamente.';
            }
//            $routeOptions = array(
//                'id' => $newBarrio->getId(),
//                '_format' => $request->get('_format')
//            );
            $response = array(
                'status' => 'Ok',
                'code' => $statusCode,
                'message' => $msg,
                'data' => $usuario
            );
            return $response;
        } catch (InvalidFormException $exception) {
            return $exception->getForm();
        }
    }
    
    /**
     * Actualiza un usuario existente con los datos de un formulario, si no existe el usuario crea uno nuevo
     * 
     * @Patch("/api/usuario/{id}")
     *
     * @param Request $request the request object
     * @param int     $id      usuario id
     *
     * @return FormTypeInterface|View
     *
     * @throws NotFoundHttpException when tag not exist
     */
    public function patchUsuarioAction(Request $request, $id)
    {
        try {
            $usuario = $this->container->get('concejo.usuario.handler')->patch(
                $this->getOr404($id),
                $request->request->all()
            );
            $statusCode = Codes::HTTP_OK;
            $response = array(
                'status' => 'Ok',
                'code' => $statusCode,
                'message' => 'Se editó el usuario exitosamente.',
                'data' => $usuario
            );
            return $response;
        } catch (InvalidFormException $exception) {
            return $exception->getForm();
        }
    }
    
    /**
     * Elimina un usuario existente
     *
     * @Delete("/api/usuario/{id}")
     * 
     * @param Request $request the request object
     * @param int     $id      usuario id
     *
     * @return FormTypeInterface|View
     *
     * @throws NotFoundHttpException when tag not exist
     */
    public function deleteUsuarioAction(Request $request, $id)
    {
        $usuario = $this->container->get('concejo.usuario.handler')->delete($this->getOr404($id));
        $statuscode = Codes::HTTP_OK;
        $response = array(
            'status' => 'Ok',
            'code' => $statuscode,
            'message' => 'El usuario fue eliminado con exito.'
        );
        return $response;
    }
    
    
    /**
     * Devuelve el usuario o un 404 Exception.
     *
     * @param mixed $id
     *
     * @return UsuarioInterface
     *
     * @throws NotFoundHttpException
     */
    protected function getOr404($id)
    {
        if (!($usuario = $this->container->get('concejo.usuario.handler')->get($id))) {
            throw new NotFoundHttpException(sprintf('El elemento \'%s\' no se encontró.',$id));
        }
        return $usuario;
    }	

}
