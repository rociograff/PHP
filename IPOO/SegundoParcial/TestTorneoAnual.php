<?php
include_once 'Partido.php';
include_once 'Equipo.php';
include_once 'Categoria.php';
include_once 'MinisterioDeporte.php';
include_once 'Torneo.php';
include_once 'Provincial.php';
include_once 'Nacional.php';

//INCISO 1
$objE1 = new Equipo("Equipo 1", "Cap E1", "11", "Menores");
$objE2 = new Equipo("Equipo 2", "Cap E2", "11", "Menores");
$objE3 = new Equipo("Equipo 3", "Cap E3", "11", "Juveniles");
$objE4 = new Equipo("Equipo 4", "Cap E4", "11", "Juveniles");
$objE5 = new Equipo("Equipo 5", "Cap E5", "11", "Mayores");
$objE6 = new Equipo("Equipo 6", "Cap E6", "11", "Mayores");
$objE7 = new Equipo("Equipo 7", "Cap E7", "11", "Juveniles");
$objE8 = new Equipo("Equipo 8", "Cap E8", "11", "Juveniles");
$objE9 = new Equipo("Equipo 9", "Cap E9", "11", "Mayores");
$objE10 = new Equipo("Equipo 10", "Cap E10", "11", "Mayores");
$objE11 = new Equipo("Equipo 11", "Cap E11", "11", "Mayores");
$objE12 = new Equipo("Equipo 12", "Cap E12", "11", "Mayores");

$objPart1 = new Partido(1, $objE7, $objE8, '28/06/2020', 80, 120);
$objPart2 = new Partido(2, $objE9, $objE10, '29/08/2020', 81, 110);
$objPart3 = new Partido(3, $objE11, $objE12, '14/04/2020', 115, 85);
$objPart4 = new Partido(4, $objE1, $objE2, '26/07/2020', 3, 2);
$objPart5 = new Partido(5, $objE3, $objE4, '17/09/2020', 0, 1);
$objPart6 = new Partido(6, $objE5, $objE6, '03/01/2020', 2, 3);

//INCISO 2
$colPartidosProvinciales = [$objPart1, $objPart2, $objPart3];

//INCISO 3
$colPartidosNacionales = [$objPart4, $objPart5, $objPart6];

//INCISO 4
$ministerioDeporte = new MinisterioDeporte(2020, $colPartidosProvinciales);

//INCISO 5
echo "EJECUTANDO INCISO 5 \n";
$ArrayAsociativo = [];
$objMinDep = $objMinDep->registrarTorneo($colPartidosProvinciales, 'provincial', $ArrayAsociativo);
echo $objMinDep . "\n";

//INCISO 6
echo "EJECUTANDO INCISO 6 \n";
$ArrayAsociativo = [];
$objMinDep = $objMinDep->registrarTorneo($colPartidosNacionales, 'nacional', $ArrayAsociativo);
echo $objMinDep . "\n";

//INCISO 7
echo "EJECUTANDO INCISO 7 \n";
$torneo = new Torneo($colPartidosProvinciales, 10000);
$objMinDep = otorgarPremioTorneo($idTorneo_5);
echo $objMinDep . "\n";

//INCISO 8
echo "EJECUTANDO INCISO 8 \n";
$torneo = new Torneo($colPartidosNacionales, 10000);
$objMinDep = otorgarPremioTorneo($idTorneo_6);
echo $objMinDep . "\n";

//INCISO 9
echo "EJECUTANDO INCISO 9\n";
echo $objMinDep . "\n";
