//Borro los valores cuando se completa el formulario
function borrarValores() {
    document.getElementById("txtPelicula").value = "";
    document.getElementById("txtDirector").value = "";
    document.getElementById("txtAnio").value = "";
    document.getElementById("txtCalificacion").value = "";
    document.getElementById("txtOpinion").value = "";
}

//Cambio el borde del formulario cuando no se completa o se completa mal el formulario
function cambiarBorde (campo) {
    campo.style.borderColor = "red";
}

//Verificacion del formulario
function Formulario () {
    var campo, formularioValidado;
    formularioValidado = true;

    /* ---------- Verificacion de la pelicula ---------- */
    //Almacena el valor del input "txtPelicula"
    campo = document.getElementById("txtPelicula");
    //Si el campo es vacio o nulo, se cambia el borde del input a color rojo y el formulario no es valido
    if(campo.value == "" || !isNaN(campo.value)) {
        cambiarBorde(campo);
        formularioValidado = false;
    }

    /* ---------- Verificacion del director ---------- */
    //Almacena el valor del input "txtDirector"
    campo = document.getElementById("txtDirector");
    //Si el campo es vacio o nulo, se cambia el borde del input a color rojo y el formulario no es valido
    if(campo.value == "" || !isNaN(campo.value)) {
        cambiarBorde(campo);
        formularioValidado = false;
    }

    /* ---------- Verificacion del Año ---------- */
    //Almacena el valor del input "txtAnio"
    campo = document.getElementById("txtAnio");
    var num = parseInt(campo.value);
    var fecha = new Date();
    var anioActual = fecha.getFullYear();
    var anioMinimo = 1900;
    //Si el campo es vacio o nulo, se cambia el borde del input a color rojo y el formulario no es valido
    if(campo.value == "" || isNaN(campo.value)) {
        cambiarBorde(campo);
        formularioValidado = false;
    }else {
        if((num < anioMinimo) || (num > anioActual)) {  //Verifico que el año este entre 1900 y el año actual
            cambiarBorde(campo);
            formularioValidado = false;
        }
    }

    /* ---------- Verificacion de la calificacion ---------- */
    //Almacena el valor del input "txtCalificacion"
    campo = document.getElementById("txtCalificacion");
    var puntos = parseInt(campo.value);
    //Si el campo es vacio o nulo, se cambia el borde del input a color rojo y el formulario no es valido
    if(campo.value == "" || isNaN(campo.value)) {
        cambiarBorde(campo);
        formularioValidado = false;
    }else {
        if(puntos < 1 || puntos > 10) {  //Verifico que la calificacion este entre 1 y 10 puntos
            cambiarBorde(campo);
            formularioValidado = false;
        }
    }

    /* ---------- Verificacion de la opinion ---------- */
    //Almacena el valor del input "txtOpinion"
    campo = document.getElementById("txtOpinion");
    //Si el campo es vacio o nulo, se cambia el borde del input a color rojo y el formulario no es valido
    if(campo.value == "" || !isNaN(campo.value)) {
        cambiarBorde(campo);
        formularioValidado = false;
    }

    return formularioValidado;
}

function Registro() {
    var validacionForm, cadenaPelicula, puntos, calificacion;
    validacionForm = Formulario();

    //Almacena el valor del input "txtCalificacion"
    calificacion = document.getElementById("txtCalificacion");

    //Informacion de la pelicula
    cadenaPelicula = "Pelicula: "+document.getElementById("txtPelicula").value+
    "<br/>Año: "+document.getElementById("txtAnio").value+
    "<br/>Director: "+document.getElementById("txtDirector").value+
    "<br/>Calificacion: "+calificacion.value+
    "<br/>Opinion: "+document.getElementById("txtOpinion").value+"<hr/>";

    if(validacionForm) {
        puntos = parseInt(calificacion.value);
        if(puntos >= 1 && puntos <=3) {          //1 a 3 inclusive: Pelicula Mala. 
            divGuardar = document.getElementById("PMalas");
        }else if(puntos >= 4 && puntos <= 6 ) {  //4 a 6 inclusive: Pelicula Regular
            divGuardar = document.getElementById("PRegulares");
        }else if(puntos >= 7 || puntos <=10) {   //7 a 10 inclusive: Pelicular Buena
            divGuardar = document.getElementById("PBuenas");
        }
        //Registro los valores de los inputs
        divGuardar.innerHTML+=cadenaPelicula+"\r\n";
        //Borro los valores cuando se completa el formulario
        borrarValores();  
    }
}
