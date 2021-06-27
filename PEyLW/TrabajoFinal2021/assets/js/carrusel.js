const slider = document.querySelector("#slider");
let sliderSection = document.querySelectorAll(".slider-section");
// selecciono el ultimo elemento
let sliderSectionLast = sliderSection[sliderSection.length - 1];

// selecciono botones
const btnIzq = document.querySelector("#btnizquierda");
const btnDer = document.querySelector("#btnderecha");
// coloco el ultimo slider al principio del slider
slider.insertAdjacentElement("afterbegin", sliderSectionLast);

function moverDerecha() {
    let sliderSectionFirst = document.querySelectorAll(".slider-section")[0];
    slider.style.marginLeft = "-100%";
    slider.style.transition = "all 0.5s";
    setTimeout(function() {
        slider.style.transition = "none";
        slider.insertAdjacentElement("beforeend", sliderSectionFirst);
        slider.style.marginLeft = "-100%";
    }, 500)

}

function moverIzquierda() {
    // Devuelve el primer elemento del documento 
    // (utilizando un recorrido primero en profundidad pre ordenado de los nodos del documento) 
    // que coincida con el grupo especificado de selectores.
    let sliderSection = document.querySelectorAll(".slider-section");
    let sliderSectionLast = sliderSection[sliderSection.length - 1];
    slider.style.marginLeft = "0";
    slider.style.transition = "all 0.5s";
    setTimeout(function() {
        slider.style.transition = "none";
        // El método insertAdjacentElement() inserta un elemento nodo dado en una posición dada
        //  con respecto al elemento sobre el que se invoca.
        slider.insertAdjacentElement("afterbegin", sliderSectionLast);
        slider.style.marginLeft = "-100%";
    }, 500)

}
btnDer.addEventListener("click", function() {
    moverDerecha();
});

btnIzq.addEventListener("click", function() {
    moverIzquierda();
});

setInterval(function() {
    moverDerecha();
}, 6000);