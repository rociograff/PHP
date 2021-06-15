<?php
include_once 'BaseDatos.php';
include_once 'Funcion.php';
class Obra extends Funcion {
    //Atributo
    private $autor;

    //Constructor
    public function __construct() {
        //Invoco el constructor de la clase Funcion
        parent::__construct();
        $this->autor = "";
    }

    /**
     * Metodo cargar(), que permite setear los atributos de las funciones
     * @param int $idFuncion, string $nombre, float $precio, int $hora, int $minuto, int $duracion, int $idTeatro, string $autor
     */
    public function cargar($idFuncion, $nombre, $precio, $horaInicio, $duracion, $idTeatro, $autor) {
        parent::cargar($idFuncion, $nombre, $precio, $horaInicio, $duracion, $idTeatro);
        $this->setAutor($autor);
    }

    //Observador
    public function getAutor() {
        return $this->autor;
    }

    public function getMensajeOperacion() {
        return $this->mensajeOperacion;
    }

    //Modificador
    public function setAutor($autor) {
        $this->autor = $autor;
    }

    public function setMensajeOperacion($mensajeOperacion) {
        $this->mensajeOperacion = $mensajeOperacion;
    }

    //Metodos
    /**
    * Metodo __toString() para mostrar los datos de la Obra
    * @return $cadena
    */
    public function __toString() {
        $cadena = parent::__toString();
        return $cadena."\nAutor de la Obra: ".$this->getAutor()."\n";
    }

    /*
	* Metodo darCostos() que aplica un incremento sobre el precio de la Obra y retorna un costo
	* @return $costo
	*/
    public function darCostos(){
		/*variables: int $valor, float $costo*/
		$valor = parent::darCostos();
		$costo = $valor + ($valor * 1.45); //45% incremento 
		return $costo;
	}

     /* -------------------- METODOS DE LA BASE DE DATOS -------------------- */
    /**
	 * Recupera los datos de una obra por nombre
	 * @param int $idObra
	 * @return true en caso de encontrar los datos, false en caso contrario 
	 */		
    public function Buscar($idObra) {
		$base = new BaseDatos();
		$consulta = "Select * from obra where id_funcion=".$idObra;
		$resp = false;
		if($base->Iniciar()) {
		    if($base->Ejecutar($consulta)) {
				if($row2=$base->Registro()) {	
				    parent::Buscar($idObra);
				    $this->setAutor($row2['autor']);
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
	 * Lista los datos de todas las obras que cumplen con una condicion
	 * @param String $condicion
	 * @return array $arregloObra
	 */
	public function listar($condicion) {
	    $arregloObra = array();
		$base = new BaseDatos();
		$consulta = "Select * from obra inner join funcion on obra.id_funcion = funcion.id_funcion";
		if ($condicion != ""){
		    $consulta = $consulta.' where funcion'.$condicion;
		}
		$consulta.=" order by nombre ";
		
		if($base->Iniciar()) {
		    if($base->Ejecutar($consulta)) {				
				while($row2=$base->Registro()) {
					$obj = new Obra();
					$obj->Buscar($row2['id_funcion']);
					array_push($arregloObra,$obj);
				}
		 	}else {
		 		$this->setmensajeoperacion($base->getError());
			}
		}else {
		 	$this->setmensajeoperacion($base->getError());
		}	
		return $arregloObra;
	}	

    /**
	 * Inserta una nueva instancia en la tabla obra
	 * @param
	 * @return true en caso de insertar los datos, false en caso contrario
	 */
	public function insertar() {
		$base = new BaseDatos();
		$resp = false;
		
		if(parent::insertar()) {
            $idFuncion = parent::getIdFuncion();
            $autor = $this->getAutor();
		    $consultaInsertar="INSERT INTO obra(id_funcion, autor)
			VALUES ('$idFuncion', '$autor')";
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
	 * Modifica una instancia en la tabla obra
	 * @param
	 * @return true en caso de insertar los datos, false en caso contrario
	 */
	public function modificar() {
	    $resp = false; 
	    $base = new BaseDatos();
	    if(parent::modificar()) {
            $idFuncion = parent::getIdFuncion();
            $autor = $this->getAutor();
	        $consultaModifica="UPDATE obra SET autor = '$autor' WHERE id_funcion = '$idFuncion'";

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
	 * Elimina una instancia en la tabla obra
	 * @param
	 * @return true en caso de eliminar los datos, false en caso contrario
	 */
	public function eliminar() {
		$base = new BaseDatos();
		$resp = false;
		if($base->Iniciar()) {
            $idFuncion = parent::getIdFuncion();
			$consultaBorra="DELETE FROM obra WHERE id_funcion = '$idFuncion'";

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