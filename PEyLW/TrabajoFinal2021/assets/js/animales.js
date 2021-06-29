/** 
 * Aparece el botón si el usuario ha llegado lo suficientemente abajo. Utilizo
 *  la función scroll() para saber si se ha hecho scroll o no. Si se ha desplazado más de 100px hacia abajo,
 *  el botón aparecerá, de lo contrario, lo ocultaremos.
 */
$(document).ready(function() {
    $(window).scroll(function() {
        if ($(this).scrollTop() > 100) {
            $('#scroll').fadeIn();
        } else {
            $('#scroll').fadeOut();
        }
    });
    /**
     * Una vez se haya hecho clic en el botón, debemos hacer scroll hacia la parte más superior de la web.
     *  Para ello utilizaremos la función animate() y el evento scrollTop
     */
    $('#scroll').click(function() {
        $("html, body").animate({ scrollTop: 0 }, 600);
        return false;
    });
});