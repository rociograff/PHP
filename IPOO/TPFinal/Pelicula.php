<?php
include_once 'BaseDatos.php';
include_once 'Funcion.php';
class Pelicula extends Funcion {
    //Atributos
    private $genero;
    private $paisOrigen;

    //Constructor
    public function __construct() {
        //Invoco el constructor de la clase Funciones
        parent::__construct();
        $this->genero = "";
        $this->paisOrigen = "";
    }

    /**
     * Metodo cargar(), que permite setear los atributos de las funciones
     * @param int $idFuncion, string $nombre, float $precio, int $hora, int $minuto, int $duracion, int $idTeatro, string $genero, int $cantPersonasEscena
     */
    public function cargar($idFuncion, $nombre, $precio, $horaInicio, $duracion, $idTeatro, $genero, $paisOrigen) {
        parent::cargar($idFuncion, $nombre, $precio, $horaInicio, $duracion, $idTeatro);
        $this->setGenero($genero);
        $this->setPaisOrigen($paisOrigen);
    }

    //Observadores
    public function getGenero() {
        return $this->genero;
    }

    public function getPaisOrigen() {
        return $this->paisOrigen;
    }

    public function getMensajeOperacion() {
        return $this->mensajeOperacion;
    }

    //Modificadores
    public function setGenero($genero) {
        $this->genero = $genero;
    }

    public function setPaisOrigen($paisOrigen) {
        $this->paisOrigen = $paisOrigen;
    }

    public function setMensajeOperacion($mensajeOperacion) {
        $this->mensajeOperacion = $mensajeOperacion;
    }

    //Metodos
    /**
    * Metodo __toString() para mostrar los datos del Cine
    * @return $cadena
    */
    public function __toString() {
        $cadena = parent::__toString();
        return $cadena."\nGenero de la pelicula: ".$this->getGenero()."\n".
        "Pais de origen de la pelicula: ".$this->getPaisOrigen()."\n";
    }

    /*
	* Metodo darCostos() que aplica un incremento sobre el precio de la pelicula en el Cine y retorna un costo
	* @return int $costo
	*/
    public function darCostos(){
		/*variables: int $valor, float $costo*/
		$valor = parent::darCostos();
		$costo = $valor + ($valor * 1.65);  //65% incremento
		return $costo;
	}

    /* -------------------- METODOS DE LA BASE DE DATOS -------------------- */
    /**
	 * Recupera los datos de una pelicula por nombre
	 * @param int $idPelicula
	 * @return true en caso de encontrar los datos, false en caso contrario 
	 */		
    public function Buscar($idPelicula) {
		$base = new BaseDatos();
		$consulta = "Select * from pelicula where id_funcion=".$idPelicula;
		$resp = false;
		if($base->Iniciar()) {
		    if($base->Ejecutar($consulta)) {
				if($row2=$base->Registro()) {	
				    parent::Buscar($idPelicula);
				    $this->setGenero($row2['genero']);
                    $this->setPaisOrigen($row2['pais_origen']);
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
	 * Lista los datos de todas las peliculas que cumplen con una condicion
	 * @param String $condicion
	 * @return array $arregloPelicula
	 */
	public function listar($condicion) {
	    $arregloPelicula = array();
		$base = new BaseDatos();
		$consulta = "Select * from pelicula inner join funcion on pelicula.id_funcion = funcion.id_funcion";
		if ($condicion != ""){
		    $consulta = $consulta.' where funcion'.$condicion;
		}
		$consulta.=" order by nombre ";
		
		if($base->Iniciar()) {
		    if($base->Ejecutar($consulta)) {				
				while($row2=$base->Registro()) {
					$obj = new Pelicula();
					$obj->Buscar($row2['id_funcion']);
					array_push($arregloPelicula, $obj);
				}
		 	}else {
		 		$this->setmensajeoperacion($base->getError());
			}
		}else {
		 	$this->setmensajeoperacion($base->getError());
		}	
		return $arregloPelicula;
	}	

    /**
	 * Inserta una nueva instancia en la tabla pelicula
	 * @param
	 * @return true en caso de insertar los datos, false en caso contrario
	 */
	public function insertar() {
		$base = new BaseDatos();
		$resp = false;
		
		if(parent::insertar()) {
            $idFuncion = parent::getIdFuncion();
            $genero = $this->getGenero();
            $paisOrigen = $this->getPaisOrigen();
		    $consultaInsertar="INSERT INTO pelicula(id_funcion, genero, pais_origen)
			VALUES ('$idFuncion', '$genero', '$paisOrigen')";
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
	 * Modifica una instancia en la tabla pelicula
	 * @param
	 * @return true en caso de insertar los datos, false en caso contrario
	 */
	public function modificar() {
	    $resp = false; 
	    $base = new BaseDatos();
	    if(parent::modificar()) {
            $idFuncion = parent::getIdFuncion();
            $genero = $this->getGenero();
            $paisOrigen = $this->getPaisOrigen();
	        $consultaModifica="UPDATE pelicula SET genero = '$genero', pais_origen = '$paisOrigen' WHERE id_funcion = '$idFuncion'";

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
	 * Elimina una instancia en la tabla pelicula
	 * @param
	 * @return true en caso de eliminar los datos, false en caso contrario
	 */
	public function eliminar() {
		$base = new BaseDatos();
		$resp = false;
		if($base->Iniciar()) {
            $idFuncion = parent::getIdFuncion();
			$consultaBorra="DELETE FROM pelicula WHERE id_funcion = '$idFuncion'";

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