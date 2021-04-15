<?php
class Empresa {
    //Atributos
    private $denominacion;
    private $direccion;
    private $colClientes;
    private $colProductos;
    private $colVentas;

    //Constructor 
    public function __construct($den, $dire, $objClientes, $objProductos, $objVentas) {
        $this->denominacion = $den;
        $this->direccion = $dire;
        $this->colClientes = $objClientes;
        $this->colProductos = $objProductos;
        $this->colVentas = $objVentas;
    }

    //Observadoras
    public function getDenominacion() {
        return $this->denominacion;
    }

    public function getDireccion() {
        return $this->direccion;
    }

    public function getColClientes() {
        return $this->colClientes;
    }

    public function getColProductos() {
        return $this->colProductos;
    }

    public function getColVentas() {
        return $this->colVentas;
    }

    //Modificadoras
    public function setDenominacion($den) {
        $this->denominacion = $den;
    }

    public function setDireccion($dire) {
        $this->direccion = $dire;
    }

    public function setColClientes($objClientes) {
        $this->colClientes = $objClientes;
    }

    public function setColProductos($objProductos) {
        $this->colProductos = $objProductos;
    }

    public function setColVentas($objVentas) {
        $this->colVentas = $objVentas;
    }

    //Metodos
    /**
     * Metodo que recorre la colección de productos de la Empresa y retorna la
     * referencia al objeto producto cuyo código coincide con el recibido por parámetro.
     * 
     * @param $codigoProducto
     * @return Producto $retorno
     */
    public function retornarProducto($codigoProducto) {
        //Declaracion de variables
        //int $i
        //boolean $encontrado
        $i = 0;
        $encontrado = false;
        while ($i < count($this->colProductos) && !$encontrado) {
            if ($this->colProductos[$i]->getCodigo() == $codigoProducto) {
                $retorno = $this->colProductos[$i];
                $encontrado = true;
            } else {
                $retorno = null;
                $i++;
            }
        }
        return $retorno;
    }

    /**
     * Método que recibe por parámetro una colección de códigos de productos, la cual es recorrida, 
     * se busca el objeto producto correspondiente  al código y se incorpora a la colección de productos
     * de la instancia Venta que debe ser creada.
     * Recordar que no todos los clientes ni todos los productos, están disponibles para registrar una venta en
     * un momento determinado.
     * El método debe setear los variables instancias de venta que corresponda y retornar el importe final de la venta.
     *
     * @param $colCodigosProductos, $objCliente
     * @return boolean $exito
     */
    public function registrarVenta($colCodigosProductos, $objCliente) {
        //Declaracion de variables
        //Venta $nuevaVenta
        //Producto $nuevoProducto
        //int $codigoProducto
        if (!$objCliente->getDadoDeBaja()) {
            for ($i = 0; $i < count($colCodigosProductos); $i++) {
                $codigoProducto = $colCodigosProductos[$i];
                $nuevoProducto = $this->retornarProducto($codigoProducto);
                if ($nuevoProducto != null) {
                    if ($nuevoProducto->getActivo()) {
                        $exito = true;
                        $numero = count($this->colVentas);
                        $fecha = date('Y');
                        $nuevaVenta = new Venta($numero, $fecha, $objCliente);
                        $nuevaVenta->incorporarProducto($nuevoProducto);
                    }
                    $this->colVentas[count($this->colVentas)] = $nuevaVenta;
                } else {
                    $exito = false;
                }
            }
        } else {
            $exito = false;
        }
        return $exito;
    }

    /**
     * Metodo que recibe por párametro el tipo y número de documento de un Cliente y 
     * retorna una colección con las ventas realizadas al cliente.
     * @param $tipo, $numDoc
     * @return Array Venta $ventasRealizadas
     */
    public function retornarVentasPorCliente($tipo, $numDoc) {
        //Array Venta $ventasRealizadas
        //Venta $venta
        //Cliente $cliente
        //int $i
        $ventasRealizadas = [];
        for ($i = 0; $i < count($this->colVentas); $i++) {
            $venta = $this->colVentas[$i];
            if ($venta != null) {
                $cliente = $venta->getCliente();
                if ($cliente->getTipoDoc() == $tipo && $cliente->getNumeroDoc() == $numDoc) {
                    $ventasRealizadas[count($ventasRealizadas)] = $venta;
                }
            }
        }
        return $ventasRealizadas;
    }

    /**
     * Metodo toString() para mostrar los datos de la Empresa
     */
    public function __toString() {
        return "\nDenominacion: ".$this->getDenominacion().
        "\nDireccion: ".$this->getDireccion().
        "\nClientes: ".$this->mostrarClientes().
        "\nProductos: ".$this->mostrarProductos().
        "\nVentas: ".$this->mostrarVentas();
    }

    /**
     * Metodo para mostrar los datos del arreglo de Productos
     * @return String $retorno
     */
    public function mostrarClientes() {
        //Declaracion de variables 
        //Array Cliente $arreglo
        $retorno = "";
        $arreglo = $this->getColClientes();
        foreach ($arreglo as $i) {
            $retorno .= $i . "\n";
            $retorno .= "----------------------------------------------------------------------\n";
        }
        return $retorno;
    }

    /**
     * Metodo para mostrar los datos del arreglo de Productos
     * @return String $retorno
     */
    public function mostrarProductos() {
        //Declaracion de variables 
        //Array Producto $arreglo
        $retorno = "";
        $arreglo = $this->getColProductos();
        foreach ($arreglo as $i) {
            $retorno .= $i . "\n";
            $retorno .= "----------------------------------------------------------------------\n";
        }
        return $retorno;
    }

    /**
     * Metodo para mostrar los datos del arreglo de Productos
     * @return String $retorno
     */
    public function mostrarVentas() {
        //Declaracion de variables 
        //Array Producto $arreglo
        $retorno = "";
        $arreglo = $this->getColVentas();
        foreach ($arreglo as $i) {
            $retorno .= $i . "\n";
            $retorno .= "----------------------------------------------------------------------\n";
        }
        return $retorno;
    }
}