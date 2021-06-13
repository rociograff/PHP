function factorial(){
	var salida;
	var num = prompt("Introduce un número y se mostrará su factorial: ",0);
	var resultado = 1;
	var i;
	for(i = num; i > 0; i--) {
  		resultado = resultado * i;
	}
	salida = document.getElementById("salida");
	salida.value += 'factorial de '+' '+num+' = '+resultado+'\n';
}