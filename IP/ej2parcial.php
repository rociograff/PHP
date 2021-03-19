<?php
//PROGRAMA PRINCIPAL
//Este programa lee todos los valores de los envios
//Luego invoca a los modulos que calculan los costos de dichos envios
//float $distancia, $costoTotal, $valorDescuento
//String $formaDePago, $tieneCupon, $diaSemana
echo "Ingrese la distancia del recorrido: " ;
$distacia = trim ( fgets (STDIN));
$costoTotal = calcularCostoReal($distancia);
echo "Ingrese el dia del envio (LU, MA, MI, JU, VI, SA, DO): " ;
$diaSemana = trim ( fgets (STDIN));
echo "Ingrese la forma de pago (efectivo, credito, debito): " ;
$formaDePago = trim ( fgets (STDIN));
echo "¿Tiene un cupon de descuento? (si/no)" ;
$tieneCupon = trim ( fgets (STDIN));
$valorDescuento = calcularDescuento ($costoTotal, $diaSemana, $formaDePago, $cuponDeDescuento);
echo "Para una distancia de ",$distancia, "km el costo es $",$costoTotal, ", con un descuento de $",$valorDescuento, ", el valor final es $", $costoTotal - $valorDescuento;

/**
* MODULO calcularCostoReal
*
* Este modulo recibe por parametro una cantidad de
* kilometros y retorna el costo del envio con esa distancia
*
* @param $km
* @return float $costo
*/
function calcularCostoReal($km) {
    //float $costo
    if ($km < 1.5) {
        $costo = 65.5 ;
    }else if ($km >= 1.5 && $km < 4.5) {
        $costo = 98.6 ;
    }else if ($km >= 4.5 && $km < 10) {
        $costo = 156.00 ;
    }else {
        $costo = 170.5 + ($km - 10) * 6.5 ;
    }
    return $costo ;
}

/**
* MODULO calcularDescuento
*
* Este modulo recibe por parametro el costo del envio, el dia de la
* semana, la forma de pago y si tiene un cupon de descuento, y retorna el descuento que se le aplica al envio
*
* @param $importeTotal, $dia, $medioDePago, $cupon
* @return $descuento
*/
function calcularDescuento($importeTotal, $dia, $medioDePago, $cupon) {
    //float $descuento
    //int $porcentajeDescuento
    if ($medioDePago == "credito") {
        if ($dia == "JU" || $dia == "VI") {
            $porcentajeDescuento = 25 ;
        }else {
            $porcentajeDescuento = 3 ;
        }
    }else {
        $porcentajeDescuento = 5 ;
    }
    if ($cupon == "si") {
        $porcentajeDescuento += 10 ;
    }
    $descuento = ($importeTotal * $porcentajeDescuento) / 100;

    return $descuento;
}
?>