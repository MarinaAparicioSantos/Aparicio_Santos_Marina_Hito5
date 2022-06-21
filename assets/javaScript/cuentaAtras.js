document.addEventListener('DOMContentLoaded', () => {

    var finSubasta = document.getElementById('finSubasta').getAttribute('value');

    const fechaFin = new Date(finSubasta);

    const dias = document.querySelector('span#days');
    const horas = document.querySelector('span#hours');
    const minutes = document.querySelector('span#minutes');
    const segundos = document.querySelector('span#seconds');


    const milisegundos = 1000;
    const milisegundosMinuto = milisegundos * 60;
    const milisegundosHora = milisegundosMinuto * 60;
    const milisegundosDia = milisegundosHora * 24


    /**
     * Función que actualiza la cuenta atrás.
     */
    function updateCountdown() {
   
        var hoy = new Date()
 
        var duracion = fechaFin - hoy;
        var diasRestantes = Math.floor(duracion / milisegundosDia);
        var horasRestantes = Math.floor((duracion % milisegundosDia) / milisegundosHora);
        var minutosRestantes = Math.floor((duracion % milisegundosHora) / milisegundosMinuto);
        var segundosRestantes = Math.floor((duracion % milisegundosMinuto) / milisegundos);

        sessionStorage.setItem("diasSesion", diasRestantes);
        sessionStorage.setItem("horasSerion", horasRestantes);
        sessionStorage.setItem("minutosSesion", minutosRestantes);
        sessionStorage.setItem("segundosSesion", segundosRestantes);

        //Si el contador llega a 0, aparece el boton de reservar obra.
        if (segundosRestantes <= 0 && minutosRestantes <= 0 && horasRestantes <= 0 && diasRestantes <= 0) {

            dias.textContent = 0;
            minutes.textContent = 0;
            horas.textContent = 0;
            segundos.textContent = 0;

            diasRestantes = 0;
            horasRestantes = 0;
            minutosRestantes = 0;
            segundosRestantes = 0;

            clearInterval(intervalo);

            if (document.getElementById("reserva")) {
                var reserva = document.getElementById("reserva");
                reserva.style.display = 'block';
            }

        } else {

            dias.textContent = diasRestantes;
            horas.textContent = horasRestantes;
            minutes.textContent = minutosRestantes;
            segundos.textContent = segundosRestantes;
        }
    }

    updateCountdown();

    var intervalo = setInterval(updateCountdown, milisegundos);

});




