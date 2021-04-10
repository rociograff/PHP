<?php
class Teatro {
    //Atributos
    private $nombreTeatro;
    private $direccionTeatro;
    private $arregloFunciones;

    //Constructor
    public function __construct($nombre, $direccion) {
        $this -> nombreTeatro = $nombre;
        $this -> direccionTeatro = $direccion;
        $this -> arregloFunciones = [];
    }

    //Observadores
    public function getNombre() {
        return $this -> nombreTeatro;
    }

    public function getDireccion() {
        return $this -> direccionTeatro;
    }

    public function getFunciones() {
        return $this -> arregloFunciones;
    }

    //Modificadores
    public function setNombre($nombre) {
        $this -> nombreTeatro = $nombre;
    }

    public function setDireccion ($direccion) {
        $this -> direccionTeatro = $direccion;
    }

    public function setFunciones($arreglo) {
        $this -> arregloFunciones = $arreglo;
    }

    //Metodos

     /**
     * Busca la existencia de una funcion requerida
     * De ser asi, devuelve la posicion en la que se encuentra
     */
    public function buscarFuncion($funcionBuscada) {
        /**
         * Declaracion de variables
         * int $indiceFuncion, $i
         * string $funcionBuscada
         * */

        $pos = -1;
        $i = 0;

        while ($i < count($this->funciones) && $pos == -1) {
            if ($this->arregloFunciones[$i]->getNombre() == $funcionBuscada) {
                $pos = $i;
            } else {
                $i++;
            }
        }
        return $pos;
    }

    /**
     * Metodo que verifica que el horario de las funciones no se solapen en un mismo teatro
     * @param $funcion
     * @return $seSolapa
     */
    public function seSolapan($funcion) {
        $seSolapa = false;
        $i = 0;

        while (!$seSolapa && $i < count($this->arregloFunciones)) {
            $duracion = $this->arregloFunciones[$i]->getDuracion();
            $horaFuncion = $this->arregloFunciones[$i]->horaAMinutos();
            $total = $duracion + $horaFuncion;
            if ($funcion->horaAMinutos() > $total || $horaFuncion > ($funcion->horaAMinutos() + $funcion->getDuracion())) {
                $seSolapa = false;
                $i++;
            } else {
                $seSolapa = true;
            }
        }
        return $seSolapa;
    }

    /**
     * Metodo toString() para mostrar los datos del Teatro
     * @return $cadena 
     */
    public function __toString() {
        return "Teatro: " . $this->getNombre() . "\n" .
        "Direccion: " . $this->getDireccion() . "\n" .
        "Funciones: " . $this->mostrarFunciones();
    }

    /**
     * Metodo para mostrar el listado de las funciones del teatro
     * @return $retorno
     */
    private function mostrarFunciones() {
        //Array Funcion $arreglo
        //String $retorno
        $retorno = "";
        $arreglo = $this->getFunciones();
        foreach ($arreglo as $i) {
            $retorno .= $i . "\n";
            $retorno .= "----------------------------------------------------------------------\n";
        }
        return $retorno;
    }
}