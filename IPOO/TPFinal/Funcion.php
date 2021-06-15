<?php
include_once 'BaseDatos.php';
class Funcion {
    //Atributos
    private $idFuncion;
    private $nombre;
    private $precio;
    private $horaInicio;
    private $duracion;
    private $idTeatro;
    private $mensajeOperacion;

    //Constructor
    public function __construct() {
        $this->idFuncion = 0;
        $this->nombre = "";
        $this->precio = 0;
        $this->horaInicio = "";
        $this->duracion = 0;
        $this->idTeatro = 0;
    }

    /**
     * Metodo cargar(), que permite setear los atributos de las funciones
     * @param int $idFuncion, string $nombre, float $precio, int $hora, int $minuto, int $duracion, int $idTeatro
     */
    public function cargar($idFuncion, $nombre, $precio, $horaInicio, $duracion, $idTeatro) {
        $this->setIdFuncion($idFuncion);
        $this->setNombre($nombre);
        $this->setPrecio($precio);
        $this->setHoraInicio($horaInicio);
        $this->setDuracion($duracion);
        $this->setIdTeatro($idTeatro);
    }

    //Observadores
    public function getIdFuncion() {
        return $this->idFuncion;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getPrecio() {
        return $this->precio;
    }

    public function getHoraInicio() {
        return $this->horaInicio;
    }

    public function getDuracion() {
        return $this->duracion;
    }

    public function getIdTeatro() {
        return $this->idTeatro;
    }

    public function getMensajeOperacion() {
        return $this->mensajeOperacion;
    }

    //Modificadores
    public function setIdFuncion($idFuncion) {
        $this->idFuncion = $idFuncion;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setPrecio($precio) {
        $this->precio = $precio;
    }

    public function setHoraInicio($horaInicio) {
        $this->horaInicio = $horaInicio;
    }

    public function setDuracion($duracion) {
        $this->duracion = $duracion;
    }

    public function setIdTeatro($idTeatro) {
        $this->idTeatro = $idTeatro;
    }

    public function setMensajeOperacion($mensajeOperacion) {
        $this->mensajeOperacion = $mensajeOperacion;
    }

    //Metodos 
    /**
     * Metodo __toString() para mostrar los datos de las Funciones
     * @return $cadena
     */
    public function __toString() {
        return "\nId Funcion: ".$this->getIdFuncion()."\n".
        "Nombre: ".$this->getNombre()."\n". 
        "Precio: $".$this->getPrecio()."\n". 
        "Hora inicio: ".$this->getHoraInicio()."\n". 
        "Duracion: ".$this->getDuracion()." minutos.\n";
    }

    /**
     * Metodo para convertir las horas con formato hh:mm a minutos
     * @return $totalMinutos
     */
    public function horaAMinutos() {
        //String $hora
        //int $horasPartes, $totalMinutos
        $hora = $this->getHoraInicio();  //Hora a convertir en minutos

        if(strpos($hora, ':') !== false) { //Encuentra la posición de la primera ocurrencia de un substring en un string
            //Realizo una particion que separe la parte de la hora y la parte de los minutos
            $horasPartes = explode(":", $hora);
        }
        //La parte de la hora la multiplicamos por 60 para pasarla a minutos y asi realizar la suma de los minutos totales
        $totalMinutos = ($horasPartes[0] * 60) + $horasPartes[1];

        return $totalMinutos;
    }

    /** 
	 * Metodo darCostos() que retorna el precio de las Funciones
	 * @return float $valor
	 */
    public function darCostos(){
		$valor = $this->getPrecio();
		return $valor;
	}

    /* -------------------- METODOS DE LA BASE DE DATOS -------------------- */
    /**
	 * Recupera los datos de una funcion por nombre
	 * @param int $idFuncion
	 * @return true en caso de encontrar los datos, false en caso contrario 
	 */		
    public function Buscar($idFuncion) {
		$base = new BaseDatos();
		$consulta = "Select * from funcion where id_funcion=".$idFuncion;
		$resp = false;
		if($base->Iniciar()) {
		    if($base->Ejecutar($consulta)) {
				if($row2 = $base->Registro()){	
				    $this->setIdFuncion($idFuncion);
                    $this->setNombre($row2['nombre']);
                    $this->setPrecio($row2['precio']);
                    $this->setHoraInicio($row2['hora_inicio']);
                    $this->setDuracion($row2['duracion']);
                    $this->setIdTeatro($row2['id_teatro']);
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
	 * Lista los datos de todos las funciones que cumplen con una condicion
	 * @param String $condicion
	 * @return array $arregloFuncion
	 */
	public function listar($condicion) {
	    $arregloFuncion = array();
		$base = new BaseDatos();
		$consulta = "Select * from funcion ";
		if ($condicion != "") {
		    $consulta = $consulta.' where '.$condicion;
		}
		$consulta.=" order by nombre ";
		
		if($base->Iniciar()) {
		    if($base->Ejecutar($consulta)) {				
				while($row2=$base->Registro()) {
                    $idFuncion = $row2['id_funcion'];
                    $nombreFuncion = $row2['nombre'];
                    $precio = $row2['precio'];
                    $horaInicio = $row2['hora_inicio'];
                    $duracion = $row2['duracion'];
                    $idTeatro = $row2['id_teatro'];
					$funcion = new Funcion();
					$funcion->cargar($idFuncion, $nombreFuncion, $precio, $horaInicio, $duracion, $idTeatro);
					array_push($arregloFuncion, $funcion);
				}
		 	}else {
		 		$this->setmensajeoperacion($base->getError());
			}
		}else {
		 	$this->setmensajeoperacion($base->getError());
		}	
		return $arregloFuncion;
	}	

    /**
	 * Inserta una nueva instancia en la tabla funcion
	 * @param
	 * @return true en caso de insertar los datos, false en caso contrario
	 */
	public function insertar(){
		$base = new BaseDatos();
		$resp = false;
        $nombre = $this->getNombre();
        $precio = $this->getPrecio();
        $hora = $this->getHoraInicio();
        $duracion = $this->getDuracion();
        $idTeatro = $this->getIdTeatro();
		
		$consultaInsertar="INSERT INTO funcion(nombre, precio, hora_inicio, duracion, id_teatro)
		VALUES ('$nombre', '$precio', '$hora', '$duracion', '$idTeatro')";

		if($base->Iniciar()){
		    if($idFuncion = $base->Ejecutar($consultaInsertar)){
                $this->setIdFuncion($idFuncion);
		        $resp=  true;
		    }else {
		        $this->setmensajeoperacion($base->getError());
		    }
		}else {
		    $this->setmensajeoperacion($base->getError());
		}
		return $resp;
	}
	
    /**
	 * Modifica una instancia en la tabla funcion
	 * @param
	 * @return true en caso de insertar los datos, false en caso contrario
	 */
	public function modificar(){
	    $resp = false; 
	    $base = new BaseDatos();
        $idFuncion = $this->getIdFuncion();
        $nombre = $this->getNombre();
        $precio = $this->getPrecio();
        $hora = $this->getHoraInicio();
        $duracion = $this->getDuracion();
        $idTeatro = $this->getIdTeatro();

	    $consultaModifica="UPDATE funcion SET nombre ='$nombre', precio = '$precio', hora_inicio = '$hora', duracion = '$duracion', id_teatro = '$idTeatro' WHERE id_funcion = '$idFuncion'";
	    
        if($base->Iniciar()){
	        if($base->Ejecutar($consultaModifica)){
	            $resp=  true;
	        }else{
	            $this->setmensajeoperacion($base->getError());
	        }
	    }else{
	        $this->setmensajeoperacion($base->getError());        
	    }
		return $resp;
	}
	
    /**
	 * Elimina una instancia en la tabla funcion
	 * @param
	 * @return true en caso de eliminar los datos, false en caso contrario
	 */
	public function eliminar() {
		$base = new BaseDatos();
		$resp = false;
		if($base->Iniciar()) {
            $idFuncion = $this->getIdFuncion();
			$consultaBorra="DELETE FROM funcion WHERE id_funcion = '$idFuncion'";
			if($base->Ejecutar($consultaBorra)){
				$resp=  true;
			}else{
				$this->setmensajeoperacion($base->getError());		
			}
		}else{
			$this->setmensajeoperacion($base->getError());	
		}
		return $resp; 
	}
}