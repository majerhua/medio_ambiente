<?php

namespace MedioAmbienteBundle\Repository;

/**
 * ContaminacionRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */

use Doctrine\DBAL\DBALException;

class ContaminacionRepository extends \Doctrine\ORM\EntityRepository
{
	public function guardarContaminacion($distrito,$calidadAire,$humedad,$temperatura,$co2,$anio,$mes){
		//try {
		    $query = "	INSERT INTO contaminacion(idDistrito,calidadAire,humedad,temperatura,co2,anio,mes) VALUES('$distrito','$calidadAire','$humedad','$temperatura','$co2','$anio','$mes')";
		    $stmt = $this->getEntityManager()->getConnection()->prepare($query);
		    $stmt->execute();
        $result = '1';
            return $result;
        //}catch (DBALException $e) {
          //  $message = $e->getCode();
        //    return $message;
        //}
	}

	public function modificarContaminacion($distrito,$calidadAire,$humedad,$temperatura,$co2,$anio,$mes,$id){
		//try {
		    $query = "UPDATE contaminacion SET idDistrito='$distrito',calidadAire='$calidadAire',humedad='$humedad',temperatura='$temperatura',co2='$co2',anio='$anio',mes='$mes' WHERE id=$id; ";
		    $stmt = $this->getEntityManager()->getConnection()->prepare($query);
		    $stmt->execute();
        $result = '1';
            return $result;
        //}catch (DBALException $e) {
          //  $message = $e->getCode();
           // return $message;
        //}
	}

	public function eliminarContaminacion($id){
		// try {
		    $query = "DELETE FROM contaminacion WHERE id='$id'";
		    $stmt = $this->getEntityManager()->getConnection()->prepare($query);
		    $stmt->execute();
        $result = '1';
            return $result;
        // }catch (DBALException $e) {
        //     $message = $e->getCode();
        //     return $message;
        // }
	}

	public function getContaminacion(){

	    $query = "	SELECT cont.id id,dist.nombre distrito, cont.calidadAire, cont.humedad, cont.temperatura, cont.co2, cont.anio, cont.mes FROM contaminacion cont
	    			INNER JOIN distrito dist ON dist.id = cont.idDistrito;";
	    $stmt = $this->getEntityManager()->getConnection()->prepare($query);
	    $stmt->execute();
	    $contaminacion = $stmt->fetchAll();
	    return $contaminacion;
	}


	public function getContaminacionByDistrito($idDistrito){

	    $query ="SELECT cont.id id,
	    				dist.nombre distrito, 
	    				cont.calidadAire,
	    				cont.humedad,
	    				cont.temperatura,
	    				cont.co2,
	    				cont.anio,
	    				cont.mes 
	    			FROM contaminacion cont
	    			INNER JOIN distrito dist ON dist.id = cont.idDistrito
                    WHERE cont.idDistrito = $idDistrito;";
	    $stmt = $this->getEntityManager()->getConnection()->prepare($query);
	    $stmt->execute();
	    $contaminacion = $stmt->fetchAll();
	    return $contaminacion;
	}

	public function getContaminacionByDistritoIndicador($idDistrito,$idIndicador){

		$subquery = "";

		if( $idIndicador == 1 ){
			$subquery = "cont.calidadAire indicador,";
		}else if( $idIndicador == 2 ){
			$subquery = "cont.humedad indicador,";
		}else if( $idIndicador == 3 ){
			$subquery = "cont.temperatura indicador,";
		}else if( $idIndicador == 4 ){
			$subquery = "cont.co2 indicador,";
		}

		$query =   "";
	    $query .=  "SELECT cont.id id,dist.nombre distrito,"; 
	    $query .=  $subquery;
	    $query .=	"	cont.anio,
	    				cont.mes 
	    				FROM contaminacion cont
	    				INNER JOIN distrito dist ON dist.id = cont.idDistrito
                    	WHERE cont.idDistrito = $idDistrito;";
	    $stmt = $this->getEntityManager()->getConnection()->prepare($query);
	    $stmt->execute();
	    $contaminacion = $stmt->fetchAll();
	    return $contaminacion;
	}

	public function getContaminacionById($id){

	    $query = "SELECT *FROM contaminacion WHERE id=$id";
	    $stmt = $this->getEntityManager()->getConnection()->prepare($query);
	    $stmt->execute();
	    $contaminacion = $stmt->fetchAll();
	    return $contaminacion;
	}


	public function getDistritos(){

	    $query = "SELECT *FROM distrito;";
	    $stmt = $this->getEntityManager()->getConnection()->prepare($query);
	    $stmt->execute();
	    $distrito = $stmt->fetchAll();
	    return $distrito;
	}

}
