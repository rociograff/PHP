/**Muestra los años */
function mostrarAnio() {
    var campo = document.getElementById("anioNacimiento");
    for (let index = 2003; index >= 1950; index--) {
        campo.innerHTML += "<option>" + index + "</option>";
    }
}

/**Muestro los años para la tarjeta de credito */
function mostrarAnioVencimiento() {
    var campo = document.getElementById("anioVencimiento");
    for (let index = 2040; index >= 2021; index--) {
        campo.innerHTML += "<option>" + index + "</option>";
    }
}

/**Muestra los meses */
function mostrarMes() {
    var campo = document.getElementById("mesNacimiento");
    var meses = [
        "Enero",
        "Febrero",
        "Marzo",
        "Abril",
        "Mayo",
        "Junio",
        "Julio",
        "Agosto",
        "Septiembre",
        "Octubre",
        "Noviembre",
        "Diciembre",
    ];
    for (let index = 0; index < meses.length; index++) {
        campo.innerHTML += "<option>" + meses[index] + "</option>";
    }
}

/**Muestro los meses en numeros */
function mostrarMesNumero() {
    var campo = document.getElementById("mesVencimiento");
    for (let index = 1; index < 13; index++) {
        var cadena;
        if (index <= 9) {
            cadena = "0" + index;
        } else {
            cadena = index;
        }
        campo.innerHTML += "<option>" + cadena + "</option>";
    }
}

/**Muestra los dias */
function mostrarDia() {
    var anio = document.getElementById("anioNacimiento").value;
    var mes = document.getElementById("mesNacimiento").value;
    var cantDias = 0;
    if (!isNaN(anio) && mes != "Mes") {
        //Verifico si es año bisiesto
        if (anio % 4 == 0) {
            if (mes == "Febrero") {
                var cantDias = 29;
            } else {
                if (
                    mes == "Enero" ||
                    mes == "Marzo" ||
                    mes == "Mayo" ||
                    mes == "Julio" ||
                    mes == "Agosto" ||
                    mes == "Octubre" ||
                    mes == "Diciembre"
                ) {
                    cantDias = 31;
                } else {
                    cantDias = 30;
                }
            }
        } else {
            if (mes == "Febrero") {
                cantDias = 28;
            } else if (
                mes == "Enero" ||
                mes == "Marzo" ||
                mes == "Mayo" ||
                mes == "Julio" ||
                mes == "Agosto" ||
                mes == "Octubre" ||
                mes == "Diciembre"
            ) {
                cantDias = 31;
            } else {
                cantDias = 30;
            }
        }
    }

    campo = document.getElementById("diaNacimiento");
    campo.innerHTML = "<option>" + "Dia" + "</option>";
    for (let index = 1; index <= cantDias; index++) {
        campo.innerHTML += "<option>" + index + "</option>";
    }
}

/**Verifico los campos del formulario para que se muestren o se oculten */
function verificarCampo() {
    var campo = document.getElementById("seleccion-asunto");
    var asunto;

    switch (campo.value) {
        case "Quiero ser donante":
            asunto = document.getElementById("asuntoDonar");
            //Para cambiar a la clase que muestra los campos
            asunto.className = "shown"
                //Ocultar en caso de que hayan sido mostradas
            document.getElementById("asuntoVoluntario").className = "hidden";
            document.getElementById("asuntoOtro").className = "hidden";
            marcarCorrecto(campo);
            break;
        case "Quiero ser voluntario":
            asunto = document.getElementById("asuntoVoluntario");
            //Para cambiar a la clase que muestra los campos
            asunto.className = "shown";
            //Ocultar en caso de que hayan sido mostradas
            document.getElementById("asuntoDonar").className = "hidden";
            document.getElementById("asuntoOtro").className = "hidden";
            marcarCorrecto(campo);
            break;
        case "Quiero más información":
            asunto = document.getElementById("asuntoOtro");
            //Para cambiar a la clase que muestra los campos
            asunto.className = "shown";
            //Ocultar en caso de que hayan sido mostradas
            document.getElementById("asuntoDonar").className = "hidden";
            document.getElementById("asuntoVoluntario").className = "hidden";
            marcarCorrecto(campo);
            break;
    }
}

/**Verifico el formulario haciendo todas las validaciones */
function verificarFormulario() {
    var campo;
    var valido = true;

    campo = document.getElementById("nombre");
    if (campo.value.match(/[0-9]/) || campo.value == "") {
        valido = false;
        marcarIncorrecto(campo);
    } else {
        marcarCorrecto(campo);
    }

    campo = document.getElementById("apellido");
    if (campo.value.match(/[0-9]/) || campo.value == "") {
        valido = false;
        marcarIncorrecto(campo);
    } else {
        marcarCorrecto(campo);
    }

    campo = document.getElementById("seleccion-asunto");
    switch (campo.value) {
        case "":
            marcarIncorrecto(campo);
            break;
        case "Quiero ser donante":
            validarDonar();
            break;
        case "Quiero ser voluntario":
            validarVoluntario();
            break;
        case "Quiero más información":
            validarOtro();
            break;
    }

    //Si todos los datos son correctos muestro un alert y cargo nuevamente la pagina
    if (valido) {
        alert("Datos Correctos");
        location.replace("../pages/contacto.html");
    }
}

/**Valido los campos de la opcion para donar */
function validarDonar() {
    valido = true;
    campo = document.getElementById("numeroTarjeta");
    if (campo.value.match(/[A-Za-z]/) || campo.value.length != 16) {
        valido = false;
        marcarIncorrecto(campo);
    } else {
        marcarCorrecto(campo);
    }

    campo = document.getElementById("codigoSeguridad");
    if (campo.value.match(/[A-Za-z]/) || campo.value.length != 3) {
        valido = false;
        marcarIncorrecto(campo);
    } else {
        marcarCorrecto(campo);
    }

    campo = document.getElementById("mesVencimiento");
    if (campo.value == "Mes") {
        valido = false;
        marcarIncorrecto(campo);
    } else {
        marcarCorrecto(campo);
    }

    campo = document.getElementById("anioVencimiento");
    if (campo.value == "Año") {
        valido = false;
        marcarIncorrecto(campo);
    } else {
        marcarCorrecto(campo);
    }

    campo = document.getElementById("documento");
    if (campo.value.match(/[A-Za-z]/) || campo.value.length < 7) {
        valido = false;
        marcarIncorrecto(campo);
    } else {
        marcarCorrecto(campo);
    }

    return valido;
}

/**Valido los campos para la opcion de ser voluntario */
function validarVoluntario() {
    valido = true;
    campo = document.getElementById("anioNacimiento");
    if (campo.value == "Año") {
        valido = false;
        marcarIncorrecto(campo);
    } else {
        marcarCorrecto(campo);
    }

    campo = document.getElementById("mesNacimiento");
    if (campo.value == "Mes") {
        valido = false;
        marcarIncorrecto(campo);
    } else {
        marcarCorrecto(campo);
    }

    campo = document.getElementById("diaNacimiento");
    if (campo.value == "Dia") {
        valido = false;
        marcarIncorrecto(campo);
    } else {
        marcarCorrecto(campo);
    }

    campo = document.getElementById("mailVoluntario");
    var emailRegex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
    if (!emailRegex.test(campo.value)) {
        valido = false;
        marcarIncorrecto(campo);
    } else {
        marcarCorrecto(campo);
    }

    return valido;
}

/**Valido los campos para la opcion de recibir mas informacion */
function validarOtro() {
    valido = true;
    campo = document.getElementById("mailOtro");
    var emailRegex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
    if (!emailRegex.test(campo.value)) {
        valido = false;
        marcarIncorrecto(campo);
    } else {
        marcarCorrecto(campo);
    }

    campo = document.getElementById("msj");
    if (campo.value == "" || campo.value.length < 100) {
        valido = false;
        marcarIncorrecto(campo);
    } else {
        marcarCorrecto(campo);
    }

    return valido;
}

/**Cambio el color del borde a rojo cuando los datos son incorrectos o vacios */
function marcarIncorrecto(campo) {
    campo.style.border = "2px solid red";
}

/**Cambio el color del borde a verde cuando se cargo correctamente los datos */
function marcarCorrecto(campo) {
    campo.style.border = "2px solid green";
}