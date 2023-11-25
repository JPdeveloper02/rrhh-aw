//MANEJAR EVENTOS DE ACUERDO A VALOR DEL SELECT
document.addEventListener('DOMContentLoaded', function() {
  const opcionSelect = document.getElementById('select_contrato');
  const input_motivo = document.getElementsByClassName('motivo_cese');

  opcionSelect.addEventListener('change', function() {
    const selectedOption = opcionSelect.value;

    // Mostrar el div correspondiente a la opción seleccionada
    if (selectedOption === '6') {
      document.getElementById('renovacion').style.display = 'block';
      document.getElementById('renuncia').style.display = 'none';
      document.getElementById('fin_contrato').style.display = 'none';
    } else if (selectedOption === '1' || selectedOption === '3' || selectedOption === '4' || selectedOption === '5') {
      document.getElementById('renuncia').style.display = 'block';
      document.getElementById('fin_contrato').style.display = 'none';
      document.getElementById('renovacion').style.display = 'none';
    } else if (selectedOption === '2') {
      document.getElementById('fin_contrato').style.display = 'block';
      document.getElementById('renovacion').style.display = 'none';
      document.getElementById('renuncia').style.display = 'none';
    }

    Array.from(input_motivo).forEach(function(element) {
      element.value = selectedOption;
    });
  });
});

//ENVIAR FORMULARIO AL SERVIDOR PARA REGISTRAR
  //RENOVAR
   // Manejar el envío del formulario por AJAX
   document.getElementById('form_renovacion').addEventListener('submit', function(event) {
    event.preventDefault(); // Evitar el envío normal del formulario
  
    const formData = new FormData(this); // Obtener los datos del formulario
  
    // Enviar la petición AJAX
    fetch(this.action, {
        method: 'POST',
        body: formData
    })
    .then(function(response) {
        return response.json();
    })
    .then(function(data) {
        if (data.success) {
            // Mostrar alerta de éxito con dos botones
            Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: '¡Contrato renovado con éxito!',
                showCancelButton: true,
                cancelButtonText: 'Aceptar',
                confirmButtonText: 'Descargar contrato',
                showLoaderOnConfirm: true,
                preConfirm: function() {
                    // Realizar acción con la variable
                    var idContrato = data.idNuevoContrato;
                    // Resto del código...
                    var enlace = '/descargar/contrato/' + idContrato;
                    window.location.href = enlace;
                }
            });
        } else {
            // Mostrar alerta de error con dos botones
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: data.error,
                showCancelButton: true,
                confirmButtonText: 'Aceptar'
            });
        }
    })
    .catch(function(error) {
        // Mostrar alerta de error si ocurre un error en la petición
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Ocurrió un problema al enviar la solicitud',
            showCancelButton: true,
            confirmButtonText: 'Aceptar'
        });
    });
  });