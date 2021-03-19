<?php
//PROGRAMA PRINCIPAL
/*Este programa lee los datos de las personas para saber si tienen covid o no
e imprime cada paciente con caso positivo, el porcentaje de casos y el promedio de edades*/
//String $nombre, $ciudad, $nombreMayorEdad, $ciudadMayorEdad, $continuar
//int $edad, $mayorEdad, $sumaEdades, $cantCasosNqn, $noSospechosos, $cantLlamadosNqn, $casosSospechosos
//boolean $sospechoso
//float $porcentaje, $promedio

$mayorEdad = 0;
$sumaEdades = 0;
$cantCasosNqn = 0;
$noSospechosos = 0;
$cantLlamadosNqn = 0;
$casosSospechosos = 0;
echo "¿Se ingresara alguna persona? ";
$continuar = trim(fgets(STDIN));
if ($continuar == "si") {
    while ($continuar != "no") {
        echo "Ingrese el nombre del paciente: ";
        $nombre = trim(fgets(STDIN));
        echo "Ingrese la edad del paciente: ";
        $edad = trim(fgets(STDIN));
        echo "Ingrese la ciudad en la que vive: ";
        $ciudad = trim(fgets(STDIN));
        echo "¿El paciente presenta sintomas? (si/no)";
        $sospechoso = trim(fgets(STDIN));
 
        if ($sospechoso == "si" && $edad >= $mayorEdad) {
            $mayorEdad = $edad;
            $nombreMayorEdad = $nombre;
            $ciudadMayorEdad = $ciudad;
        }
 
        if ($ciudad == "Neuquen") {
            $cantLlamadosNqn++;
        }
 
        if ($ciudad == "Neuquen" && $sospechoso == "si") {
            $cantCasosNqn++;
        }
 
        if ($sospechoso == "no") {
            $noSospechosos++;
        } else {
            $casosSospechosos++;
            $sumaEdades += $edad;
        }
 
        echo "¿Va a ingresar mas datos? (si/no) ";
        $continuar = trim(fgets(STDIN));
    }
}

//Calculo el porcentaje de casos sospechosos del total de llamados en neuquen
$porcentaje = $cantLlamadosNqn * $cantCasosNqn / 100;
//Calculo el promedio de edades de la cantidad de casos sospechosos
$promedio = $sumaEdades / $casosSospechosos;

echo "El paciente ".$nombreMayorEdad. " con la edad de ".$mayorEdad. " viviendo en ".$ciudadMayorEdad. " es una caso sospechoso.";
echo "La cantidad total de personas no sospechosas son: ".$noSospechosos;
echo "El porcentaje de casos sospechosos en la ciudad de Neuquen es: ".$porcentaje;
echo "El promedio de edades de personas con casos sospechosos es: ".$promedio;
