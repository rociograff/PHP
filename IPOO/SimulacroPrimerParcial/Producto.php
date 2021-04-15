<?php
class Producto {
    //Atributos
    private $codigo;
    private $costo;
    private $anioFabricacion;
    private $descripcion;
    private $porcentajeIncremento;
    private $activo;

    //Constructor
    public function __construct($cod, $costo, $anio, $description, $porcAnual, $activo) {
        $this->codigo = $cod;
        $this->costo = $costo;
        $this->anioFabricacion = $anio;
        $this->descripcion = $description;
        $this->porcentajeIncremento = $porcAnual;
        $this->activo = $activo;
    }

    //Observadoras
    public function getCodigo() {
        return $this->codigo;
    }

    public function getCosto() {
        return $this->costo;
    }

    public function getAnioFabricacion() {
        return $this->anioFabricacion;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getPorcentajeIncremento() {
        return $this->porcentajeIncremento;
    }

    public function getActivo() {
        return $this->activo;
    }

    //Modificadoras
    public function setCodigo($cod) {
        $this->codigo = $cod;
    }

    public function setCosto($costo) {
        $this->costo = $costo;
    }

    public function setAnioFabricacion($anio) {
        $this->anioFabricacion = $anio;
    }

    public function setDescripcion($description) {
        $this->descripcion = $description;
    }

    public function setPorcentajeIncremento($porcAnual) {
        $this->porcentajeIncremento = $porcAnual;
    }

    public function setActivo($activo) {
        $this->activo = $activo;
    }

    //Metodos
    /**
     * Metodo el cual calcula el valor por el que puede ser vendido el producto
     * Declaracion de variables
     * float $compra: es el costo del producto.
     * int $anio: cantidad de años trascurridos desde que se fabrico el producto.
     * float $porIncAnual: porcentaje incremento anual del producto.
     * @return float $venta
     */
    public function darPrecioVenta() {
        $compra = $this->getCosto();
        $anio = 2021 - $this->getAnioFabricacion();
        $porIncAnual = $this->getPorcentajeIncremento(); 
        if($this->getActivo()) {
            $venta = $compra + $compra * ($anio * $porIncAnual);
        }else {
            $venta = -1;
        }
        return $venta;
    }

    /**
     * Metodo toString() para mostrar los datos del producto
     */
    public function __toString() {
        //String $si, $no
        $si = "Si";
        $no = "No";
        return "\nCodigo: ".$this->getCodigo().
        "\nCosto $: ".$this->getCosto().
        "\nAnio Fabricacion: ".$this->getAnioFabricacion().
        "\nDescripcion: ".$this->getDescripcion().
        "\nPorcentaje Incremento Anual: ".$this->getPorcentajeIncremento()."%".
        "\nActivo: ".($this->getActivo() ? $si : $no);
    }
}