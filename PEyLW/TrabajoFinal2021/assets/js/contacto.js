/**Muestra los años */
function mostrarAnio(id) {
    var campo = document.getElementById(id);
    for (let index = 2003; index >= 1950; index--) {
        campo.innerHTML += "<option>" + index + "</option>";
    }
}

/**Muestra los meses */
function mostrarMes(id) {
    var campo = document.getElementById(id);
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

/**Verifico los campos del formulario para que se muestren o se oculten */
function verificarCampo() {
    var campo = document.getElementById("seleccion-asunto");
    var tarjeta = document.getElementById("tarjeta");
    var codigo = document.getElementById("codigoTarjeta");
    var vencimiento = document.getElementById("vencimiento");
    var dni = document.getElementById("dni");
    var nacimiento = document.getElementById("nacimiento");
    var email = document.getElementById("email");
    var mensaje = document.getElementById("mensaje");

    switch (campo.value) {
        case "donar":
            //Para cambiar a la clase que muestra los campos
            tarjeta.className = "shown";
            codigo.className = "shown";
            vencimiento.className = "shown";
            dni.className = "shown";
            //Ocultar en caso de que hayan sido mostradas
            nacimiento.className = "hidden";
            email.className = "hidden";
            mensaje.className = "hidden";
            marcarCorrecto(campo);
            break;
        case "voluntario":
            //Ocultar en caso de que hayan sido mostradas
            tarjeta.className = "hidden";
            codigo.className = "hidden";
            vencimiento.className = "hidden";
            dni.className = "hidden";
            mensaje.className = "hidden";
            //Para cambiar a la clase que muestra los campos
            nacimiento.className = "shown";
            email.className = "shown";
            marcarCorrecto(campo);
            break;
        case "otro":
            //Ocultar en caso de que hayan sido mostradas
            mensaje.className = "shown";
            //Para cambiar a la clase que muestra los campos
            tarjeta.className = "hidden";
            codigo.className = "hidden";
            vencimiento.className = "hidden";
            dni.className = "hidden";
            nacimiento.className = "hidden";
            email.className = "hidden";
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
        case "donar":
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
            if (campo.value == "") {
                valido = false;
                marcarIncorrecto(campo);
            } else {
                marcarCorrecto(campo);
            }

            campo = document.getElementById("anioVencimiento");
            if (campo.value == "") {
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
            break;
        case "voluntario":
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

            campo = document.getElementById("mail");
            var emailRegex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
            if (!emailRegex.test(campo.value)) {
                valido = false;
                marcarIncorrecto(campo);
            } else {
                marcarCorrecto(campo);
            }
            break;
        case "otro":
            campo = document.getElementById("msj");
            if (campo.value == "" || campo.value.length < 100) {
                valido = false;
                marcarIncorrecto(campo);
            } else {
                marcarCorrecto(campo);
            }
            break;
    }

    //Si todos los datos son correctos muestro un alert y cargo nuevamente la pagina
    if (valido) {
        alert("Datos Correctos");
        location.replace("../pages/contacto.html");
    }
}

/**Cambio el color del borde a rojo cuando los datos son incorrectos o vacios */
function marcarIncorrecto(campo) {
    campo.style.border = "2px solid red";
}

/**Cambio el color del borde a verde cuando se cargo correctamente los datos */
function marcarCorrecto(campo) {
    campo.style.border = "2px solid green";
}