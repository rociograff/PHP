<?php
class MinisterioDeporte {
    //Atributos
    private $anioTorneo;
    private $colTorneos;

    //Constructor
    public function __construct($anioTorneo, $colTorneos) {
        $this->anioTorneo = $anioTorneo;
        $this->colTorneos = $colTorneos;
    }

    //Observadores
    public function getAnioTorneo() {
        return $this->anioTorneo;
    }

    public function getColTorneos() {
        return $this->colTorneos;
    }

    //Modificadores
    public function setAnioTorneo($anioTorneo) {
        $this->anioTorneo = $anioTorneo;
    }

    public function setColTorneos($colTorneos) {
        $this->colTorneos = $colTorneos;
    }

    //Metodos 
    /*Metodo __toString() para mostrar los datos del Ministerio de Deporte */
    public function __toString() {
        return "Año del Torneo: ".$this->getAnioTorneo()."\n".
        "------TORNEOS------\n".$this->mostrarColeccion($this->getColTorneos())."\n";
    }

    /* Metodo para mostrar colecciones */
    private function mostrarColeccion($coleccion) {
        $arreglo = "";
        foreach ($coleccion as $obj) {
            $arreglo .= $obj . "\n";
            $arreglo .= "--------------------------\n";
        }
        return $arreglo;
    }

    /*Metodo registrarTorneo($colPartidos, $tipo, $arrayAsociativo) que recibe la coleccion de partidos que se van a
    jugar en el torneo, el tipo que indica si es nacional o provincial y un arreglo asociativo cuyas claves van a 
    conicidir con la info necesaria para crear el torneo dependiendo de su tipo. El metodo debe retornar la instancia
    de la clase Torneo creada segun corresponda. */
    public function registrarTorneo($colPartidos, $tipo, $arrayAsociativo) {
        $montoPremio = $arrayAsociativo["montoPremio"];
        $nombreLocalidad = $arrayAsociativo["localidad"];
        $nombreProvincia = $arrayAsociativo["provincia"];
        $idTorneo = count($this->getColTorneos());
    
        //De acuerdo al tipo de Torneo creo la instancia...
        if($tipo == "provincial") {
            $torneo = new Provincial($idTorneo, $colPartidos, $montoPremio, $nombreLocalidad, $nombreProvincia);
        }else {
            $torneo = new Nacional($idTorneo, $colPartidos, $montoPremio, $nombreLocalidad);
        }
        //Retorno la instancia de la clase Torneo segun corresponda
        return $torneo;
    }

    /*Metodo otorgarPremioTorneo($idTorneo) el cual debe retornar el objeto del equipo ganador y el importe correspondiente
    a su premio. Para la implementacion del metodo debe invocar a/los metodos implementaos. */
    public function otorgarPremioTorneo($idTorneo) {

    }
}