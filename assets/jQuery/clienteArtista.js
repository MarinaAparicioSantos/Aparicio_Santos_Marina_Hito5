//Oculta y muestra el formulario de artista.

$(document).ready(function () {
    $('.artista').click(function () {
        $(".artistaMostrar").fadeIn();
        $(".ajustarCliente").show();
        
    });

    $('.cliente').click(function () {
        $(".artistaMostrar").hide();
        $(".ajustarCliente").hide();
    });
});
