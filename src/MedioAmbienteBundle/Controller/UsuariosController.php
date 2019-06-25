<?php

namespace MedioAmbienteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class UsuariosController extends Controller
{

	/**
     * @Route("/panel/usuarios/guardar",name="usuario_guardar")
    */
	public function guardarUsuarioAction(Request $request){

    	$nombre = $request->get('nombre');
    	$apellidoPaterno = $request->get('apellidoPaterno');
        $apellidoMaterno = $request->get('apellidoMaterno');
        $correo = $request->get('correo');
        $username = $request->get('username');
        $password = $request->get('password');
        $estado = 1;
    	$rol = '["ROLE_USER"]';

        $em = $this->getDoctrine()->getManager(); 
        $result = $em->getRepository('MedioAmbienteBundle:Usuarios')->guardarUsuario($nombre,$apellidoPaterno,$apellidoMaterno,$correo,$username,$password,$estado,$rol);

        if(!empty($result)){
            
            $usuarios = $em->getRepository('MedioAmbienteBundle:Usuarios')->getUsuarios();
             echo $this->renderView('MedioAmbienteBundle:Usuarios:table_usuarios.html.twig',
                                                array(
                                                    'usuarios' => $usuarios
                                                )
                                    );

           $correo = "majerhua123@gmail.com";
       
           $subject =  'Se ha registrado en la plataforma del medio ambiente!.';
           $message =  '<html>'.
                       '<head><title>Medio Ambiente</title></head>'.
                       '<body><h2>Bienvenid@</h2>'.
                       'Su usuario y password son los siguientes: '.
                       '<hr>'.
                       '<p>Usuario: '.$username.'</p>'.
                       '<p>Password: '.$password.'</p>'.
                       '</body>'.
                       '</html>'
                   ;
           $headers = 'From: majerhua123@gmail.com' . "\r\n" .'MIME-Version: 1.0'. "\r\n" .'Content-Type: text/html; charset=ISO-8859-1'. "\r\n";
           mail($correo,$subject,$message,$headers);


            exit;
        }else{
            return new JsonResponse($result);
        }

    }

	/**
     * @Route("/panel/usuarios/detalle",name="usuario_detalle")
    */
    public function detalleUsuarioAction(Request $request){

        $id = $request->get('id');

        $em = $this->getDoctrine()->getManager(); 
        $result = $em->getRepository('MedioAmbienteBundle:Usuarios')->getUsuarioById($id);

        return new JsonResponse($result);
    }


    /**
     * @Route("/panel/usuarios/modificar",name="usuario_modificar")
    */
    public function modificarUsuarioAction(Request $request){

    	$id = $request->get('id');
    	$nombre = $request->get('nombre');
    	$apellidoPaterno = $request->get('apellidoPaterno');
        $apellidoMaterno = $request->get('apellidoMaterno');
        $correo = $request->get('correo');
        $username = $request->get('username');
        $password = $request->get('password');
        $estado = $request->get('estado');;

        $em = $this->getDoctrine()->getManager(); 
        $result = $em->getRepository('MedioAmbienteBundle:Usuarios')->modificarUsuario($nombre,$apellidoPaterno,$apellidoMaterno,$correo,$username,$password,$estado,$id);

        if(!empty($result)){
            
            $usuarios = $em->getRepository('MedioAmbienteBundle:Usuarios')->getUsuarios();
             echo $this->renderView('MedioAmbienteBundle:Usuarios:table_usuarios.html.twig',
                                                array(
                                                    'usuarios' => $usuarios
                                                )
                                    );
            exit;
        }else{
            return new JsonResponse($result);
        }

    }

    /**
     * @Route("/panel/usuarios/eliminar",name="usuario_eliminar")
    */
    public function eliminarUsuarioAction(Request $request){

        $id = $request->get('id');

        $em = $this->getDoctrine()->getManager(); 
        $result = $em->getRepository('MedioAmbienteBundle:Usuarios')->eliminarUsuario($id);

        if(!empty($result)){
            
            $usuarios = $em->getRepository('MedioAmbienteBundle:Usuarios')->getUsuarios();
             echo $this->renderView('MedioAmbienteBundle:Usuarios:table_usuarios.html.twig',
                                                array(
                                                    'usuarios' => $usuarios
                                                )
                                    );
            exit;
        }else{
            return new JsonResponse($result);
        }
    }

    /**
     * @Route("/panel/usuarios/mostrar",name="usuario_mostrar")
    */
    public function mostrarUsuarioAction(Request $request){

        $em = $this->getDoctrine()->getManager(); 
        $usuarios = $em->getRepository('MedioAmbienteBundle:Usuarios')->getUsuarios();
         echo $this->renderView('MedioAmbienteBundle:Usuarios:table_usuarios.html.twig',
                                            array(
                                                'usuarios' => $usuarios
                                            )
                                );
        exit;   
    }   


    /**
     * @Route("/panel/usuarios",name="usuarios")
     */
    public function usuariosAction()
    {
        $em = $this->getDoctrine()->getManager(); 
        $usuarios = $em->getRepository('MedioAmbienteBundle:Usuarios')->getUsuarios();
        return $this->render('MedioAmbienteBundle:Usuarios:usuarios.html.twig',['usuarios'=>$usuarios]);
    }

}
