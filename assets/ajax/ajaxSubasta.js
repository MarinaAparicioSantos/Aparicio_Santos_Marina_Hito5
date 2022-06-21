$(document).ready(subasta);

function subasta() {

    setInterval(() => {

        ajax();

    }, 1000);;

    ajax();
}

function ajax() {

    var idSubasta = $('.idSubasta').attr('id');

    $.ajax({

        url: "./index.php?controller=obras&action=ajaxSubasta&id=" + idSubasta,
        type: "GET",

        success: function (data) {

            var arrayDatosActualizar = data.split(",");

            var precio = arrayDatosActualizar[0];

            var clientes = arrayDatosActualizar[1];

            var dniLogueado = arrayDatosActualizar[2];

            var dniGanador = arrayDatosActualizar[3];

            var nombre = arrayDatosActualizar[4];

            var apellido = arrayDatosActualizar[5];

            var apellido2 = arrayDatosActualizar[6];

            //si el contador llega a 0, desaparece el boton de reserva para quien no haya ganado y el formulario de proponer precio.
            if (sessionStorage.getItem("diasSesion") <= 0 && sessionStorage.getItem("horasSerion") <= 0 && sessionStorage.getItem("minutosSesion") <= 0 && sessionStorage.getItem("segundosSesion") <= 0) {

                if (dniLogueado != dniGanador) {

                    if (document.getElementById("reserva")) {
                        var reserva = document.getElementById("reserva");
                        reserva.style.display = 'none';
                    }
                }

                if (document.getElementById("proponerPrecio")) {
                    var reserva = document.getElementById("proponerPrecio");
                    reserva.style.display = 'none';
                }
            }

            $("#precio").text(precio + "€");

            $("#clientes").text(clientes);

            if(nombre && apellido && apellido2){
            $("#ganador").text("El mayor postor: " + "\n"+ nombre + " " + apellido + " " + apellido2);

            }
        }
    });
}