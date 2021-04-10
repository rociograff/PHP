<?php
class Funcion {
    //Atributos
    private $nombre;
    private $precio;
    private $horaInicio;
    private $duracion;

    //Constructor
    public function __construct($nom, $pre, $horaIni, $time) {
        //La duracion de la funcion es en minutos
        $this->nombre = $nom;
        $this->precio = $pre;
        $this->horaInicio = $horaIni;
        $this->duracion = $time;
    }

    //Observadores
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

    //Modificadores
    public function setNombre($nom) {
        $this->nombre = $nom;
    }

    public function setPrecio($pre) {
        $this->precio = $pre;
    }

    public function setHoraInicio($horaIni) {
        $this->horaInicio = $horaIni;
    }

    public function setDuracion($time) {
        $this->duracion = $time;
    }

    public function __toString() {
        return "\tNombre: " . $this->getNombre() . 
        "\n\tPrecio: $" . $this->getPrecio() . 
        "\n\tHora inicio: " . $this->getHoraInicio() . 
        "\n\tDuracion: " . $this->getDuracion() . " minutos";
    }

    public function horaAMinutos() {
        //int $i, $minutos, $prod
        //String $hora
        $i = 0;
        $minutos = 0;
        $prod = 10;
        $hora = $this->getHoraInicio();
        while ($hora[$i] != ":") {
            $minutos += (intval($hora[$i], 10)) * $prod;
            $i++;
            $prod /= 10;
        }
        $i = 3;
        $minutos *= 60;
        $prod = 10;
        while ($i != strlen($hora)) {
            $minutos += (intval($hora[$i], 10)) * $prod;
            $prod /= 10;
            $i++;
        }
        return $minutos;
    }
}