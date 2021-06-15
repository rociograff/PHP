<?php
include_once 'BaseDatos.php';
include_once 'Funcion.php';
class Musical extends Funcion {
    //Atributos
    private $director;
    private $cantPersonasEscena;

    //Constructor
    public function __construct() {
        //invoco el constructor de la clase Funcion
        parent::__construct();
        $this->director = "";
        $this->cantPersonas = ""; 
    }

    /**
     * Metodo cargar(), que permite setear los atributos de las funciones
     * @param int $idFuncion, string $nombre, float $precio, int $hora, int $minuto, int $duracion, int $idTeatro, string $director, int $cantPersonasEscena
     */
    public function cargar($idFuncion, $nombre, $precio, $horaInicio, $duracion, $idTeatro, $director, $cantPersonasEscena) {
        parent::cargar($idFuncion, $nombre, $precio, $horaInicio, $duracion, $idTeatro);
        $this->setDirector($director);
        $this->setCantPersonasEscena($cantPersonasEscena);
    }

    //Observadores
    public function getDirector() {
        return $this->director;
    }

    public function getCantPersonasEscena() {
        return $this->cantPersonasEscena;
    }

    public function getMensajeOperacion() {
        return $this->mensajeOperacion;
    }

    //Modificadores
    public function setDirector($director) {
        $this->director = $director;
    }

    public function setCantPersonasEscena($cantPersonasEscena) {
        $this->cantPersonasEscena = $cantPersonasEscena;
    }

    public function setMensajeOperacion($mensajeOperacion) {
        $this->mensajeOperacion = $mensajeOperacion;
    }

    //Metodos
    /**
    * Metodo __toString() para mostrar los datos del Musical
    * @return $cadena
    */
    public function __toString() {
        $cadena = parent::__toString();
        return $cadena."\nDirector del musical: ".$this->getDirector()."\n".
        "Cantidad de personas en escena: ".$this->getCantPersonasEscena()."\n";
    }

    /*
	* Metodo darCostos() que aplica un incremento sobre el precio del Musical y retorna un costo
	* @return int $costo
	*/
    public function darCostos(){
		/*variables: int $valor, float $costo*/
		$valor = parent::darCostos();
		$costo = $valor + ($valor * 1.12);  //12% incremento
		return $costo;
	}

    /* -------------------- METODOS DE LA BASE DE DATOS -------------------- */
    /**
	 * Recupera los datos de un musical por nombre
	 * @param int $idMusical
	 * @return true en caso de encontrar los datos, false en caso contrario 
	 */		
    public function Buscar($idMusical) {
		$base = new BaseDatos();
		$consulta = "Select * from musical where id_funcion=".$idMusical;
		$resp = false;
		if($base->Iniciar()) {
		    if($base->Ejecutar($consulta)) {
				if($row2=$base->Registro()) {	
				    parent::Buscar($idMusical);
				    $this->setDirector($row2['director']);
                    $this->setCantPersonasEscena($row2['cant_personas']);
					$resp= true;
				}				
		 	}else {
		 		$this->setmensajeoperacion($base->getError());
			}
		}else {
		 	$this->setmensajeoperacion($base->getError()); 	
		}		
		return $resp;
	}	
    
    /**
	 * Lista los datos de todos los musicales que cumplen con una condicion
	 * @param String $condicion
	 * @return array $arregloMusical
	 */
	public function listar($condicion) {
	    $arregloMusical = array();
		$base = new BaseDatos();
		$consulta = "Select * from musical inner join funcion on musical.id_funcion = funcion.id_funcion";
		if ($condicion != ""){
		    $consulta = $consulta.' where funcion'.$condicion;
		}
		$consulta.=" order by nombre ";
		
		if($base->Iniciar()) {
		    if($base->Ejecutar($consulta)) {				
				while($row2=$base->Registro()) {
					$obj = new Musical();
					$obj->Buscar($row2['id_funcion']);
					array_push($arregloMusical,$obj);
				}
		 	}else {
		 		$this->setmensajeoperacion($base->getError());
			}
		}else {
		 	$this->setmensajeoperacion($base->getError());
		}	
		return $arregloMusical;
	}	

    /**
	 * Inserta una nueva instancia en la tabla musical
	 * @param
	 * @return true en caso de insertar los datos, false en caso contrario
	 */
	public function insertar() {
		$base = new BaseDatos();
		$resp = false;
		
		if(parent::insertar()) {
            $idFuncion = parent::getIdFuncion();
            $director = $this->getDirector();
            $cantPersonas = $this->getCantPersonasEscena();
		    $consultaInsertar="INSERT INTO musical(id_funcion, director, cant_personas)
			VALUES ('$idFuncion', '$director', '$cantPersonas')";
		    if($base->Iniciar()) {
		        if($base->Ejecutar($consultaInsertar)) {
		            $resp = true;
		        }else {
		            $this->setMensajeOperacion($base->getError());
		        }
		    }else {
		        $this->setMensajeOperacion($base->getError());
		    }
		}
		return $resp;
	}
	
	/**
	 * Modifica una instancia en la tabla musical
	 * @param
	 * @return true en caso de insertar los datos, false en caso contrario
	 */
	public function modificar() {
	    $resp = false; 
	    $base = new BaseDatos();
	    if(parent::modificar()) {
            $idFuncion = parent::getIdFuncion();
            $director = $this->getDirector();
            $cantPersonas = $this->getCantPersonasEscena();
	        $consultaModifica="UPDATE musical SET director = '$director', cant_personas = '$cantPersonas' WHERE id_funcion = '$idFuncion'";

	        if($base->Iniciar()) {
	            if($base->Ejecutar($consultaModifica)) {
	                $resp=  true;
	            }else {
	                $this->setMensajeOperacion($base->getError());   
	            }
	        }else {
	            $this->setMensajeOperacion($base->getError()); 
	        }
	    }	
		return $resp;
	}
	
    /**
	 * Elimina una instancia en la tabla musical
	 * @param
	 * @return true en caso de eliminar los datos, false en caso contrario
	 */
	public function eliminar() {
		$base = new BaseDatos();
		$resp = false;
		if($base->Iniciar()) {
            $idFuncion = parent::getIdFuncion();
			$consultaBorra="DELETE FROM musical WHERE id_funcion = '$idFuncion'";

			if($base->Ejecutar($consultaBorra)) {
				if(parent::eliminar()) {
				    $resp=  true;
				}
			}else {
				$this->setMensajeOperacion($base->getError());		
			}
		}else {
			$this->setMensajeOperacion($base->getError());
		}
		return $resp; 
	}
}