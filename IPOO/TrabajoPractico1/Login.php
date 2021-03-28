<?php
/*class Login {

    //Atributos
    private $nombreUsuario;
    private $contrasenia;
    private $frase;
    private $arregloConstrasenias;
    private $indiceArreglo;

    //Constructor
    public function __construct($usuario, $contra, $frase) {
        $this -> nombreUsuario = $usuario;
        $this -> contrasenia = $contra;
        $this -> frase = $frase;
        $this -> arregloContrasenias = [4];
        $this -> indiceArreglo = 0;
        $this -> arregloContrasenias[$this -> indiceArreglo] = $this -> contrasenia;
        $this -> indice++;
    }

    //Observadoras
    public function getFrase() {
        return $this -> frase;
    }

    //Metodos
    public function contraseniaValida($contra) {
        if ($this -> contrasenia == $contra) {
            $valida = true;
        }else {
            $valida = false;
        }
        return $valida;
    }

    public function cambiarContrasenia($nuevaContrasenia) {
        $i = 0;
        $valida = true;
        while($i < $this -> indiceArreglo && $valida) {
            if ($this -> arregloContrasenias[$i] == $nuevaContrasenia) {
                $valida = false;
                echo "La contrasena ingresada no puede ser igual a una anterior.";
            }else {
                $i++;
            }
        }

        if($valida) {
            $this -> arregloConstrasenias[$this -> indice] = $nuevaContrasenia;
            $this -> indice = ($this -> indice + 1) % 4;
        }

        return $valida;
    }

    public function recordar ($usuario) {
        if ($this -> nombreUsuario == $usuario) {
            $retorno = $this -> frase;
        }else {
            $retorno = "Usuario incorrecto.";
        }

        return $retorno;
    }
}*/

class Login {
    private $nombreUsuario;
    private $contraseNa;
    private $frase;
    private $arreglocontraseNas = array();
    
    
    public function __construct($nombreUsuario,$contraseNa,$frase,$arreglo){
        $this->nombreUsuario=$nombreUsuario;
        $this->contraseNa=$contraseNa;
        $this->frase=$frase;
        $this->arreglocontraseNas=$arreglo;   
    }
    
    public function getNombreUsuario(){
        return $this->nombreUsuario;
    }

    public function getContrasenia(){
        return $this->contraseNa;    
    }

    public function getFrase(){
        return $this->frase;
    }
    
    public function getArreglocontrasenias(){
        return $this->arreglocontraseNas;    
    }
    
    public function setNombreUsuario($nombreUsuario){
        $this-> nombreUsuario= $nombreUsuario;
    }

    public function setContrasenia($contraseNa){
        $this-> contraseNa = $contraseNa;  
    }

    public function setFrase($frase){
        $this-> frase = $frase;
    }
    
    public function setArregloContrasenias($arreglocontraseNas){
            $this-> arreglocontraseNas = $arreglocontraseNas;
    }
    
    public function validar($unacontraseNa){
        $respuesta=false;
        $objpass = $this->getContrasenia();
        if($unacontraseNa == $objpass){
            $respuesta = true;
        }
        return $respuesta;
    }
    
    public function cambiarPass($new) {
        $arreglopass = $this->getArregloContrasenias();
        if (!($this->validar($new))) {
            array_push($arreglopass,$new);
            $this->setContrasenia($new);
            $resp = true;
        }else{
            $resp = false;
        }
        
        return $resp;
    }
    
    public function recordar($usuario){
        $lafrase="";
        $u=$this->getNombreUsuario();
        if($usuario==$u){
            $lafrase=$this->getFrase();
        }else{
            return false;
        }
        return $lafrase;
    }
    
    public function __tostring(){
        $datos="\nNombre: ".$this->getNombreUsuario()."\nFrase: ".$this->getFrase();
        return $datos;
    }
        
}
