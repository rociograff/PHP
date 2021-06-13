function datos(){
	var contrasenia;
	contrasenia = prompt('Ingrese la contraseña',0);
	if (contrasenia == 'minombre'){
		document.write("Datos Personales </br> Nombre: Rocio </br> Apellido: Graff </br> Estado civil: Soltera </br> Edad: 24 </br> Fecha de Nacimiento: 28/06/1996 </br> DNI: ----");
	}else {
		document.write("la contrasenia es incorrecta");
	}
}