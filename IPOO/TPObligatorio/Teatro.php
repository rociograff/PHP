<?php
class Teatro {
    //Atributos
    private $nombreTeatro;
    private $direccionTeatro;
    private $funciones;

    //Constructor
    private function __construct($nombre, $direccion, $funcion) {
        $this -> nombreTeatro = $nombre;
        $this -> direccionTeatro = $direccion;
        $this -> funciones = $funcion;
    }

    //Observadores
    public function getNombre() {
        return $this -> nombreTeatro;
    }

    public function getDireccion() {
        return $this -> direccionTeatro;
    }

    public function getFunciones() {
        return $this -> funciones;
    }

    //Modificadores
    public function setNombre($nombre) {
        $this -> nombreTeatro = $nombre;
    }

    public function setDireccion ($direccion) {
        $this -> direccionTeatro = $direccion;
    }

    //Metodos

     /**
     * Busca la existencia de una funcion requerida
     * De ser asi, devuelve la posicion en la que se encuentra
     */
    public function buscarFuncion($funcionBuscada)
    {
        /**
         * Declaracion de variables
         * int $indiceFuncion, $i
         * string $funcionBuscada
         */

        // Inicializacion de variables
        $pos = -1;
        $i = 0;

        while ($i < count($this->funciones) && $pos == -1) {
            if ($this->funciones[$i]["nombre"] == $funcionBuscada) {
                $pos = $i;
            } else {
                $i++;
            }
        }
        return $pos;
    }

    /**
     * Modifica y reemplaza valores de un funcion existente por unos nuevos
     */
    public function cambiarFuncion($pos, $nuevoNombre, $nuevoPrecio) {
        //boolean $exito
        if ($pos < 4 && $pos >= 0) {
            $this->funciones[$pos]["Nombre"] = $nuevoNombre;
            $this->funciones[$pos]["Precio"] = $nuevoPrecio;
            $exito = true;
        } else {
            $exito = false;
        }
        return $exito;
    }

    public function __toString() {
        return "El Teatro: " . $this->getNombre() . "\n esta ubicado en la " . "Direccion: " . $this->getDireccion() . "\n";
    }
}