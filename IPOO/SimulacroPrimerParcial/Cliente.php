<?php 
class Cliente {
    //Atributos 
    private $nombre;
    private $apellido;
    private $dadoDeBaja;
    private $tipoDocumento;
    private $numeroDocumento;

    //Constructor
    public function __construct($nom, $ape, $deBaja, $tipoDoc, $numDoc) {
        $this->nombre = $nom;
        $this->apellido = $ape;
        $this->dadoDeBaja = $deBaja;
        $this->tipoDocumento = $tipoDoc;
        $this->numeroDocumento = $numDoc;
    }

    //Observadoras
    public function getNombre() {
        return $this->nombre;
    }

    public function getApellido() {
        return $this->apellido;
    }

    public function getDadoDeBaja() {
        return $this->dadoDeBaja;
    }

    public function getTipoDocumento() {
        return $this->tipoDocumento;
    }

    public function getNumeroDocumento() {
        return $this->numeroDocumento;
    }

    //Modificadoras
    public function setNombre($nom) {
        $this->nombre = $nom;
    }

    public function setApellido($ape) {
        $this->apellido = $ape;
    }

    public function setDadoDeBaja($deBaja) {
        $this->dadoDeBaja = $deBaja;
    }

    public function setTipoDocumento($tipoDoc) {
        $this->tipoDocumento = $tipoDoc;
    }

    public function setNumeroDocumento($numDoc) {
        $this->numeroDocumento = $numDoc;
    }

    /**
     * Metodo toString() para devolver todos los datos del cliente
     */
    public function __toString() {
        //String $si, $no
        $si = "Si";
        $no = "No";
        return "\nNombre: ".$this->getNombre().
        "\nApellido: ".$this->getApellido().
        "\nTipo Documento: ".$this->getTipoDocumento().
        "\nNumero de Documento: ".$this->getNumeroDocumento().
        "\nEsta dado de baja: ".($this->getDadoDeBaja() ? $si : $no);
    }
}