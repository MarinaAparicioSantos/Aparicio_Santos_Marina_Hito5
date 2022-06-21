window.addEventListener("load", iniciar);

function iniciar() {
    var mensaje = document.getElementById("descripcionObra");
    mensaje.addEventListener("keyup", contarCaracteres, false);
}

/**
 * 
 * @param {*} e 
 * Funcion que cuenta el numero de caracteres y lo muestra.
 */
function contarCaracteres(e) {
    var maxLength = 120;
    var longitudCadena = e.currentTarget.value.length;
    var restante = (maxLength - longitudCadena);

    document.getElementById("caracteres").innerHTML = restante + ' caracteres restantes';

}