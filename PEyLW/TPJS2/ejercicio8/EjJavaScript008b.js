function ocultar(ind){
    switch(ind){
        case 1:document.getElementById("elem1").style.display="none" 
                document.getElementById("nqn").style.textDecoration="underline";
                break;
        case 2:document.getElementById("elem2").style.display="none"
                document.getElementById("rn").style.textDecoration="underline";
                break;
        case 3:document.getElementById("elem3").style.display="none"
                document.getElementById("bsas").style.textDecoration="underline";
                break;
    }
         
}

function mostrar(ind){
    switch(ind){
        case 1:document.getElementById("elem1").style.display="block"
            document.getElementById("nqn").style.textDecoration="";
            break;
        case 2:document.getElementById("elem2").style.display="block"
            document.getElementById("rn").style.textDecoration="";
            break;
        case 3:document.getElementById("elem3").style.display="block"
            document.getElementById("bsas").style.textDecoration="";
            break;
    }
}