<?php
class Venta {
    //Atributos
    private $numero;
    private $fecha;
    private $cliente;
    private $colProducto;
    private $precioFinal;

    //Constructor 
    public function __construct($num, $date, $cliente) {
        $this->numero = $num;
        $this->fecha = $date;
        $this->cliente = $cliente;
        $this->colProducto = [];
        $this->precioFinal = 0;
    }

    //Observadoras
    public function getNumero() {
        return $this->numero;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function getCliente() {
        return $this->cliente;
    }

    public function getColProductos() {
        return $this->colProducto;
    }

    public function getPrecioFinal() {
        return $this->precioFinal;
    }

    //Modificadoras
    public function setNumero($num) {
        $this->numero = $num;
    }

    public function setFecha($date) {
        $this->fecha = $date;
    }

    public function setCliente($cliente) {
        $this->cliente = $cliente;
    }

    public function setColProductos($arregloProducto) {
        $this->colProducto = $arregloProducto;
    }

    public function setPrecioFinal($precio) {
        $this->precioFinal = $precio;
    }

    //Metodos
    /**
     * Metodo que recibe por parámetro un objeto producto y lo incorpora, si es posible la venta,
     * a la colección de productos de la venta. El método cada vez que incorpora
     * un producto a la venta, debe actualizar la variable instancia precio final de la venta.
     * @param $objProducto
     */
    public function incorporarProducto($objProducto) {
        if ($objProducto->getActivo()) {
            $this->colProductos[count($this->colProductos)] = $objProducto;
            $this->precioFinal += $objProducto->darPrecioVenta();
        }
    }

    /**
     * Metodo toString() para mostrar los datos de la venta
     */
    public function __toString() {
        return "\nNumero: ".$this->getNumero().
        "\nFecha: ".$this->getFecha().
        "\nCliente: ".$this->getCliente().
        "\nProductos: ".$this->mostrarProductos().
        "\nPrecio Final $: ".$this->getPrecioFinal();
    }

    /**
     * Metodo para mostrar los datos del arreglo de Productos
     * Declaracion de variables 
     * Array Producto $arreglo
     * @return String $retorno
     */
    public function mostrarProductos() {
        $retorno = "";
        $arreglo = $this->getColProductos();
        foreach ($arreglo as $i) {
            $retorno .= $i . "\n";
            $retorno .= "----------------------------------------------------------------------\n";
        }
        return $retorno;
    }   
}