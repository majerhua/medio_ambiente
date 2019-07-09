<?php

namespace MedioAmbienteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class ContaminacionController extends Controller
{

	/**
     * @Route("/panel/contaminacion/guardar",name="contaminacion_guardar")
    */
	public function guardarContaminacionAction(Request $request){

    	$distrito = $request->get('distrito');
    	$calidadAire = $request->get('calidadAire');
        $humedad = $request->get('humedad');
        $temperatura = $request->get('temperatura');
        $co2 = $request->get('co2');
        $anio = $request->get('anio');
        $mes = $request->get('mes');

        $em = $this->getDoctrine()->getManager(); 
        $result = $em->getRepository('MedioAmbienteBundle:Contaminacion')->guardarContaminacion($distrito,$calidadAire,$humedad,$temperatura,$co2,$anio,$mes);

        if(!empty($result)){
            
            $contaminacion = $em->getRepository('MedioAmbienteBundle:Contaminacion')->getcontaminacion();
             echo $this->renderView('MedioAmbienteBundle:Contaminacion:table_contaminacion.html.twig',
                                                array(
                                                    'contaminacion' => $contaminacion
                                                )
                                    );
            exit;
        }else{
            return new JsonResponse($result);
        }

    }

	/**
     * @Route("/panel/contaminacion/detalle",name="contaminacion_detalle")
    */
    public function detalleContaminacionAction(Request $request){

        $id = $request->get('id');

        $em = $this->getDoctrine()->getManager(); 
        $result = $em->getRepository('MedioAmbienteBundle:Contaminacion')->getContaminacionById($id);

        return new JsonResponse($result);
    }


    /**
     * @Route("/panel/contaminacion/modificar",name="contaminacion_modificar")
    */
    public function modificarContaminacionAction(Request $request){

    	$id = $request->get('id');
    	$distrito = $request->get('distrito');
    	$calidadAire = $request->get('calidadAire');
        $humedad = $request->get('humedad');
        $temperatura = $request->get('temperatura');
        $co2 = $request->get('co2');
        $anio = $request->get('anio');
        $mes = $request->get('mes');

        $em = $this->getDoctrine()->getManager(); 
        $result = $em->getRepository('MedioAmbienteBundle:Contaminacion')->modificarContaminacion($distrito,$calidadAire,$humedad,$temperatura,$co2,$anio,$mes,$id);

        if(!empty($result)){
            
            $contaminacion = $em->getRepository('MedioAmbienteBundle:Contaminacion')->getContaminacion();
             echo $this->renderView('MedioAmbienteBundle:Contaminacion:table_contaminacion.html.twig',
                                                array(
                                                    'contaminacion' => $contaminacion
                                                )
                                    );
            exit;
        }else{
            return new JsonResponse($result);
        }

    }

    /**
     * @Route("/panel/contaminacion/eliminar",name="contaminacion_eliminar")
    */
    public function eliminarContaminacionAction(Request $request){

        $id = $request->get('id');

        $em = $this->getDoctrine()->getManager(); 
        $result = $em->getRepository('MedioAmbienteBundle:Contaminacion')->eliminarContaminacion($id);

        if(!empty($result)){
            
            $contaminacion = $em->getRepository('MedioAmbienteBundle:Contaminacion')->getcontaminacion();
             echo $this->renderView('MedioAmbienteBundle:Contaminacion:table_contaminacion.html.twig',
                                                array(
                                                    'contaminacion' => $contaminacion
                                                )
                                    );
            exit;
        }else{
            return new JsonResponse($result);
        }

    }


    /**
     * @Route("/departamentos",name="departamentos")
    */
    public function detalleDepartamentosAction(Request $request){

        $em = $this->getDoctrine()->getManager(); 
        $result = $em->getRepository('MedioAmbienteBundle:Contaminacion')->getDepartamentos();

        return new JsonResponse($result);
    }

    /**
     * @Route("/provincias",name="provincias")
    */
    public function detalleProvinciasAction(Request $request){

        $idDepartamento = $request->get('idDepartamento');

        $em = $this->getDoctrine()->getManager(); 
        $result = $em->getRepository('MedioAmbienteBundle:Contaminacion')->getProvincias($idDepartamento);

        return new JsonResponse($result);
    }

    /**
     * @Route("/distritos",name="distritos")
    */
    public function detalleDistritosAction(Request $request){

        $idDepartamento = $request->get('idDepartamento');
        $idProvincia = $request->get('idProvincia');

        $em = $this->getDoctrine()->getManager(); 
        $result = $em->getRepository('MedioAmbienteBundle:Contaminacion')->getDistritos($idDepartamento,$idProvincia);

        return new JsonResponse($result);
    }


    /**
     * @Route("/panel/contaminacion/mostrar",name="contaminacion_mostrar")
    */
    public function mostrarContaminacionAction(Request $request){

        $em = $this->getDoctrine()->getManager(); 
        $contaminacion = $em->getRepository('MedioAmbienteBundle:Contaminacion')->getContaminacion();
         echo $this->renderView('MedioAmbienteBundle:Contaminacion:table_contaminacion.html.twig',
                                            array(
                                                'contaminacion' => $contaminacion
                                            )
                                );
        exit;   
    }   


    /**
     * @Route("/panel/contaminacion",name="contaminacion")
     */
    public function contaminacionAction()
    {
        $em = $this->getDoctrine()->getManager(); 
        $contaminacion = $em->getRepository('MedioAmbienteBundle:Contaminacion')->getContaminacion();
        return $this->render('MedioAmbienteBundle:Contaminacion:contaminacion.html.twig',['contaminacion'=>$contaminacion]);
    }

    /**
     * @Route("/panel/contaminacion/distrito-indicador",name="contaminacion_distrito_indicador")
    */
    public function contaminacionDistritoIndicadorAction(Request $request){

        $idDistrito = $request->get('idDistrito');
        $idIndicador = $request->get('idIndicador');

        $em = $this->getDoctrine()->getManager(); 
        $result = $em->getRepository('MedioAmbienteBundle:Contaminacion')->getContaminacionByDistritoIndicador($idDistrito,$idIndicador);

        return new JsonResponse($result);
    }

    /**
     * @Route("/panel/contaminacion/distrito",name="contaminacion_distrito")
    */
    public function contaminacionDistritoAction(Request $request){

        $idDistrito = $request->get('idDistrito');

        $em = $this->getDoctrine()->getManager(); 
        $result = $em->getRepository('MedioAmbienteBundle:Contaminacion')->getContaminacionByDistrito($idDistrito);

        return new JsonResponse($result);
    }

    // /**
    //  * @Route("/panel/contaminacion/distrito1-distrito2",name="contaminacion_distrito1_distrito2")
    // */
    // public function contaminacionDistrito1Distrito2Action(Request $request){

    //     $idDistrito1 = $request->get('idDistrito1');
    //     $idDistrito2 = $request->get('idDistrito2');

    //     $array = array();

    //     $em = $this->getDoctrine()->getManager(); 
    //     $result1 = $em->getRepository('MedioAmbienteBundle:Contaminacion')->getContaminacionByDistrito($idDistrito1);
    //     $result2 = $em->getRepository('MedioAmbienteBundle:Contaminacion')->getContaminacionByDistrito($idDistrito2);

    //     array_push($array,$result1);
    //     array_push($array,$result2);

    //     return new JsonResponse($array);
    // }

    /**
     * @Route("/panel/contaminacion/max-comparacion-distritos",name="max_contaminacion_distritos")
    */
    public function maxIndicadorComparacionDistritosAction(Request $request){

        $idDepartamento = $request->get('idDepartamento');
        $idProvincia = $request->get('idProvincia');
        $idIndicador = $request->get('idIndicador');

        $array = array();

        $em = $this->getDoctrine()->getManager(); 
        $result = $em->getRepository('MedioAmbienteBundle:Contaminacion')->getMaxIndicadorByDistrito($idDepartamento,$idProvincia,$idIndicador);

        return new JsonResponse($result);
    }


    /**
     * @Route("/panel/contaminacion/min-comparacion-distritos",name="min_contaminacion_distritos")
    */
    public function minIndicadorComparacionDistritosAction(Request $request){

        $idDepartamento = $request->get('idDepartamento');
        $idProvincia = $request->get('idProvincia');
        $idIndicador = $request->get('idIndicador');

        $array = array();

        $em = $this->getDoctrine()->getManager(); 
        $result = $em->getRepository('MedioAmbienteBundle:Contaminacion')->getMinIndicadorByDistrito($idDepartamento,$idProvincia,$idIndicador);

        return new JsonResponse($result);
    }


}
