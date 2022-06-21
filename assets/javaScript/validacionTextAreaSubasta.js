window.addEventListener("load", iniciar);

function iniciar() {
    var mensaje = document.getElementById("descripcionSubasta");
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

    document.getElementById("caracteresSubasta").innerHTML = restante + ' caracteres restantes';

}