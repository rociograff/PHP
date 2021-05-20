<?php
class Internacional extends Vuelo {
    //Atributos
    private $cantEscalas;
    private $costoPasaje;

    //Constructor
    public function __construct($numeroVuelo, $plazasEjecutivasDisponibles, $plazasEconomicasDisponibles, $horaPartida, $horaLlegada, $destinoVuelo, $avionAsignado, $importeVuelo, $cantEscalas, $costoPasaje) {
        //Invoco el constructor de la clase Vuelo
        parent::__construct($numeroVuelo, $plazasEjecutivasDisponibles, $plazasEconomicasDisponibles, $horaPartida, $horaLlegada, $destinoVuelo, $avionAsignado, $importeVuelo);
        $this->cantEscalas = $cantEscalas;
        $this->costoPasaje = $costoPasaje;
    }

    //Observador
    public function getCantEscalas() {
        return $this->cantEscalas;
    }

    public function getCostoPasaje() {
        return $this->costoPasaje;
    }

    //Modificador
    public function setCantEscalas($cantEscalas) {
        $this->cantEscalas = $cantEscalas;
    }

    public function setCostoPasaje($costoPasaje) {
        $this->costoPasaje = $costoPasaje;
    }

    //Metodos
    /*Metodo __toString() para mostrar los datos de los vuelvos Internacionales */
    public function __toString() {
        return parent::__toString()."\n".
        "Cantidad de escalas: ".$this->getCantEscalas()."\n".
        "Costo pasaje: ".$this->getCostoPasaje()."\n";
    }

    /*Metodo calcularImporte($objPasajero) que recibe por parametro un objeto Pasajero y si el vuelo es internacional
    se debe incrementar el costo con los gastos de utilización de rutas internacionales que se calcula de la siguiente
    manera: costo vuelo / cantidad de escalas * 0,7. */
    public function calcularImporte($objPasajero) {
        //Redefiniendo el metodo calcularImporte() de la clase Vuelo
        $costo = parent::calcularImporte($objPasajero);
        $costo = ($costo / ($this->getCantEscalas() * 0.7));

        return $costo;
    }
}