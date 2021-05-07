<?php
include 'Persona.php';
include 'Cuota.php';
include 'Prestamo.php';
include 'Financiera.php';

//INCISO 1 
$financiera = new Financiera("Money", "Av. Argentina 1234");

//INCISO 2
$persona1 = new Persona("Pepe", "Flores", 39647231, "Bs As 12", "dir@mail.com", 299444567, 40000);
$persona2 = new Persona("Luis", "Suarez", 40751964, "Bs As 123", "dir@mail.com", 2994455, 4000);
$persona3 = new Persona("Luis", "Suarez", 40751964, "Bs As 123", "dir@mail.com", 2994455, 4000);

$prestamo1 = new Prestamo(1, 50000, 5, 0.1, $persona1);
$prestamo2 = new Prestamo(2, 10000, 4, 0.1, $persona2);
$prestamo3 = new Prestamo(3, 10000, 2, 0.1, $persona3);
$colPrestamo = [$prestamo1, $prestamo2, $prestamo3];

//INCISO 3
echo "------EJECUTANDO INCISO 3------\n";
$financiera->incorporarPrestamo($prestamo1);
$financiera->incorporarPrestamo($prestamo2);
$financiera->incorporarPrestamo($prestamo3);

//INCISO 4
echo "------EJECUTANDO INCISO 4------\n";
echo $financiera;

//INCISO 5
echo "------EJECUTANDO INCISO 5------\n";
$financiera->otorgarPrestamoSiCalifica();

//INCISO 6
$objCuota = $financiera->informarCuotaPagar(1);
echo $objCuota;

//INCISO 7
echo "------EJECUTANDO INCISO 7------\n";
echo $objCuota;

//INCISO 8
echo "------EJECUTANDO INCISO 8------\n";
echo $objCuota->darMontoFinalCuota();

//INCISO 9
$objCuota->setCancelada(true);

//INCISO 10
$objCuota = $Financiera->informarCuotaPagar(2);
echo $objCuota;

//INCISO 11
echo "------EJECUTANDO INCISO 11------\n";
echo $objCuota;
