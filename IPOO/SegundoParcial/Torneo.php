<?php
class Torneo {
    //Atributos
    private $idTorneo;
    private $colPartidos;
    private $montoPremio;
    private $nombreLocalidad;

    //Constructor
    public function __construct($idTorneo, $colPartidos, $montoPremio, $nombreLocalidad) {
        $this->idTorneo = $idTorneo;
        $this->colPartidos = $colPartidos;
        $this->montoPremio = $montoPremio;
        $this->nombreLocalidad = $nombreLocalidad;
    }

    //Observadores
    public function getIdTorneo() {
        return $this->idTorneo;
    }

    public function getColPartidos() {
        return $this->colPartidos;
    }

    public function getMontoPremio() {
        return $this->montoPremio;
    }

    public function getNombreLocalidad() {
        return $this->nombreLocalidad;
    }

    //Modificadores
    public function setIdTorneo($idTorneo) {
        $this->idTorneo = $idTorneo;
    }

    public function setColPartidos($colPartidos) {
        $this->colPartidos = $colPartidos;
    }

    public function setMontoPremio($montoPremio) {
        $this->montoPremio = $montoPremio;
    }

    public function setNombreLocalidad($nombreLocalidad) {
        $this->nombreLocalidad = $nombreLocalidad;
    }

    //Metodos
    /*Metodo __toString() para mostrar los datos del Torneo */
    public function __toString() {
        return "ID Torneo: ".$this->getIdTorneo()."\n". 
        "------PARTIDOS------\n".$this->mostrarColeccion($this->getColPartidos())."\n".
        "Monto del premio: ". $this->getMontoPremio()."\n".
        "Nombre localidad donde se juega: ".$this->getNombreLocalidad()."\n";
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

    /*Metodo obtenerEquipoGanadorTorneo() que recorre la lista de partidos y se queda con aquel equipo que gano mas
    partidos. El metodo debe retornar un arreglo asociativo con el objeto de la clase Equipo (correspondiente al 
    equipo ganador del Torneo) y otra clave con la cantidad de goles realizados en todo el torneo. */
    public function obtenerEquipoGanadorTorneo() {
        $coleccionGanadores = array();
        $coleccionPartidos = $this->getColPartidos();
        $i = 0;
        foreach ($coleccionPartidos as $objPartido) {
            $equipoGanador = null;
            $cantGoles = 0;
            $cantGolesE1 = $objPartido->getCantGolesEq1();
            $cantGolesE2 = $objPartido->getCantGolesEq2();
            if ($cantGolesE1  > $cantGolesE2) {
                $equipoGanador = $objPartido->getEquipo1();
                $cantGoles = $cantGolesE1;
            } else if ($cantGolesE2 > $cantGolesE1) {
                $equipoGanador = $objPartido->getEquipo2();
                $cantGoles = $cantGolesE1;
            }
            $coleccionGanadores[$i] = ["ganador"=>$equipoGanador,"Goles"=>$cantGoles];
            $i++;
        }
    }

    /*Metodo obtenerPremioTorneo() que calcula el premio economico que debe ser otorgado al equipo ganador del Torneo 
    Provincial o Nacional. El premio economico es otorgado al equipo que ha ganado mas partidos. */
    public function obtenerPremioTorneo() {
        $equipoGanador = $this->obtenerEquipoGanadorTorneo();
        $montoPremio = $this->getMontoPremio();

        return $montoPremio;
    }
}