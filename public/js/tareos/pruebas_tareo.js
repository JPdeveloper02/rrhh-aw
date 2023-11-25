//ENVIAR FECHA A MODAL
$(document).ready(function() {
    $('.agregar-btn').click(function() {
      var fechaString = $(this).data('fecha');
      var partes = fechaString.split('/');
      var fechaFormateada = partes[2] + '-' + partes[1] + '-' + partes[0];
      $('#fecha_input').val(fechaFormateada);
    });
  });


  //ENVIO DE DATOS AL SERVIDOR PARA REGISTRAR
 document.getElementById('form_pruebatareo').addEventListener('submit', function(event) {
  event.preventDefault(); // Evitar el envío normal del formulario
  const formData = new FormData(this); // Obtener los datos del formulario
  fetch(this.action, {
      method: 'POST',
      body: formData
  })
  .then(function(response) {
      return response.json();
  })
  .then(function(data) {
      if (data.success) {
          // Mostrar alerta de éxito si la respuesta es exitosa
          Swal.fire({
              icon: 'success',
              title: 'Éxito',
              text: '¡Registrado con éxito!'
          }).then(function() {
              location.reload(); // Recargar la página
          });
      } else {
          // Mostrar alerta de error con el mensaje recibido
          Swal.fire({
              icon: 'error',
              title: 'Error',
              text: data.error
          });
      }
  })
  .catch(function(error) {
      // Mostrar alerta de error si ocurre un error en la petición
      Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Ocurrió un problema al enviar la solicitud'
      });
  });
});


//ENVIO DE DATOS AL SERVIDOR PARA ELININAR
const url = '/tareos/fotos/eliminar';
const token = document.head.querySelector('meta[name="csrf-token"]').content;
function eliminarRegistro(idEstacion, fecha) {
  console.log(idEstacion,fecha)

  Swal.fire({
    title: 'Confirmación',
    text: '¿Estás seguro de que deseas eliminar la prueba tareo?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Sí',
    cancelButtonText: 'Cancelar'
  }).then((result) => {
    if (result.isConfirmed) {
      fetch(url, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': token
        },
        body: JSON.stringify({
          idEstacion: idEstacion,
          fecha: fecha,
        }),
      })
      .then(function(response) {
        if (response.ok) {
          // La eliminación fue exitosa
          Swal.fire({
            icon: 'success',
            title: 'Éxito',
            text: 'El registro ha sido eliminado.',
          }).then(function() {
            // Realizar las acciones adicionales después de eliminar el registro, como recargar la página o actualizar la interfaz de usuario
            location.reload(); // Ejemplo: recargar la página
          });
        } else {
          // Ocurrió un error al eliminar el registro
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Ocurrió un problema al eliminar el registro.',
          });
        }
      })
      .catch(function(error) {
        // Ocurrió un error en la solicitud
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Ocurrió un problema al enviar la solicitud de eliminación.',
        });
      });
    }
  });
}