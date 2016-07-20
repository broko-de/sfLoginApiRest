<?php

namespace ConcejoBundle\Handler;

use Doctrine\Common\Persistence\ObjectManager;
use ConcejoBundle\HandlerInterface\UsuarioHandlerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Security\Core\SecurityContextInterface;
use ConcejoBundle\Model\UsuarioInterface;
use ConcejoBundle\Form\UsuarioType;
use ConcejoBundle\Exception\InvalidFormException;


class UsuarioHandler implements UsuarioHandlerInterface {
    
    private $om;
    private $entityClass;
    private $repository;
    private $formFactory;
    private $securityContext;

    public function __construct(ObjectManager $om, $entityClass, FormFactoryInterface $formFactory,SecurityContextInterface $securityContext) {
        $this->om = $om;
        $this->entityClass = $entityClass;
        $this->repository = $this->om->getRepository($this->entityClass);
        $this->formFactory = $formFactory;
        $this->securityContext = $securityContext;
    }
    
    /**
     * Devuelve un usuario.
     *
     * @param mixed $id
     *
     * @return UsuarioInterface
     */
    public function get($id) {
        return $this->repository->find($id);
    }
    
    /**
     * Devuelve el usuario logeado.
     *     
     *
     * @return UsuarioInterface
     */
    public function getUsuarioLogeado() {
        $userLogin = $this->securityContext->getToken()->getUser();
        if (!$userLogin){
            throw new Exception("No se ha logeado ningun usuario ", "500");
        }
        return $userLogin;
    }

    /**
     * Devuelve una lista de usuarios.
     *
     * @param int $limit  the limit of the result
     * @param int $offset starting from the offset
     *
     * @return array
     */
    public function all() {
        return $this->repository->findBy(array(), array('apellido' => 'ASC'));
    }

    /**
     * Crea un nuevo usuario.
     *
     * @param array $parameters
     *
     * @return UsuarioInterface
     */
    public function post(array $parameters) {
        $usuario = $this->createUsuario();
        return $this->processForm($usuario, $parameters, 'POST');
    }

    /**
     * Edita un usuario.
     *
     * @param UsuarioInterface $usuario
     * @param array         $parameters
     *
     * @return UsuarioInterface
     */
    public function put(UsuarioInterface $usuario, array $parameters) {        
        return $this->processForm($usuario, $parameters, 'PUT');
    }

    /**
     * Actualiza parcialmente un usuario.
     *
     * @param UsuarioInterface $usuario
     * @param array         $parameters
     *
     * @return UsuarioInterface
     */
    public function patch(UsuarioInterface $usuario, array $parameters) {
        return $this->processForm($usuario, $parameters, 'PATCH');
    }
    
    /**
     * Elimina un usuario.
     *
     * @param UsuarioInterface $usuario
     * @param array         $parameters
     *
     * @return UsuarioInterface
     */
    public function delete(UsuarioInterface $usuario) {
        $this->om->remove($usuario);
        $this->om->flush($usuario);
        return $usuario;
    }
    
    /**
     * Processes the form.
     *
     * @param UsuarioInterface $usuario
     * @param array         $parameters
     * @param String        $method
     *
     * @return UsuarioInterface
     *
     * @throws \Cilo\DenunciaBundle\Exception\InvalidFormException
     */
    private function processForm(UsuarioInterface $usuario, array $parameters, $method = "PUT") {
        $current_pass = $usuario->getPassword();
        $form = $this->formFactory->create(new UsuarioType(), $usuario, array('method' => $method));
        $form->submit($parameters, 'PATCH' !== $method);
        if ($form->isValid()) {
            $usuario = $form->getData();
            if ($method == "POST"){
                $this->setSecurePassword($usuario);
                $usuario->setFechaCreacion(new \DateTime());
            }else{
                $usuario->setFechaModificacion(new \DateTime());
                $this->setModifiedPassword($current_pass,$usuario);
            }
            $this->om->persist($usuario);
            $this->om->flush($usuario);
            return $usuario;
        }
        throw new InvalidFormException('Invalid submitted data', $form);
    }

    private function createUsuario() {
        return new $this->entityClass();
    }
    
    /**
     * Metodo para generar la contraseña de usuario
     * @param type $entity
     */
    private function setSecurePassword(&$entity) {
        $entity->setSalt(md5(time()));
        $encoder = new \Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder('sha512', true, 10);
        $password = $encoder->encodePassword($entity->getPassword(), $entity->getSalt());
        $entity->setPassword($password);
    }
    
    /**
     * metodo para actualizar la contraseña si se actualizo el password en el formulario.
     * @param type $current_pass
     * @param type $usuario
     */
    private function setModifiedPassword($current_pass, $usuario){
        if($current_pass != $usuario->getPassword()){
            $this->setSecurePassword($usuario);
        }
    }
}
