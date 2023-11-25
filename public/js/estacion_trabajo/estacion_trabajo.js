// Obtener todos los elementos select con la clase select-estado
const selectEstados = document.querySelectorAll('.select-estado');
const selectRegimen = document.querySelectorAll('.select-regimen');

//SELECT ESTADOS
selectEstados.forEach(select => {
  select.addEventListener('change', function() {
    const selectedOption = this.options[this.selectedIndex];
    const nuevoEstado = selectedOption.value;
    const idEstacion = this.dataset.idestacion; // Obtener el valor de data-idEstacion

    const confirmMessage = `¿Estás seguro de cambiar el estado a ${selectedOption.text}?`;
    console.log(idEstacion + "-" + nuevoEstado);
    // Mostrar el cuadro de diálogo de confirmación
    Swal.fire({
      title: 'Confirmación',
      text: confirmMessage,
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Sí, estoy seguro',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        // Enviar la solicitud AJAX al controlador
        // Realizar la solicitud AJAX utilizando $.ajax de jQuery
        $.ajax({
          url: url_estado,
          type: 'POST',
          headers: {
            'X-CSRF-TOKEN': csrfToken // Incluir el token CSRF en el encabezado
          },
          data: {
            estado: nuevoEstado,
            idEstacion: idEstacion // Incluir el valor de data-idEstacion
          },
          success: function(response) {
            // Mostrar una alerta de éxito utilizando SweetAlert2
            Swal.fire({
              title: 'Éxito',
              text: 'La solicitud se ha procesado correctamente',
              icon: 'success'
            }).then(() => {
              // Recargar la página
              location.reload();
            });
          },
          error: function(jqXHR, textStatus, errorThrown) {
            // Mostrar una alerta de error utilizando SweetAlert2 con el mensaje de error recibido del servidor
            Swal.fire({
              title: 'Error',
              text: 'Ha ocurrido un error al procesar la solicitud: ' + jqXHR.responseText,
              icon: 'error'
            });
          }
        });
      } else {
        // Restaurar el valor original del select si se cancela la confirmación
        this.value = this.dataset.originalValue;
      }
    });
  });
});

//SELECT REGIMEN
selectRegimen.forEach(select => {
    select.addEventListener('change', function() {
      const selectedOption = this.options[this.selectedIndex];
      const nuevoRegimen = selectedOption.value;
      const idEstacion = this.dataset.idestacion; // Obtener el valor de data-idEstacion
  
      const confirmMessage = `¿Estás seguro de cambiar el regimen a ${selectedOption.text}?`;
      console.log(idEstacion + "-" + nuevoRegimen);
      // Mostrar el cuadro de diálogo de confirmación
      Swal.fire({
        title: 'Confirmación',
        text: confirmMessage,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, estoy seguro',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
          // Enviar la solicitud AJAX al controlador
          // Realizar la solicitud AJAX utilizando $.ajax de jQuery
          $.ajax({
            url: url_regimen,
            type: 'POST',
            headers: {
              'X-CSRF-TOKEN': csrfToken // Incluir el token CSRF en el encabezado
            },
            data: {
              regimen: nuevoRegimen,
              idEstacion: idEstacion // Incluir el valor de data-idEstacion
            },
            success: function(response) {
              // Mostrar una alerta de éxito utilizando SweetAlert2
              Swal.fire({
                title: 'Éxito',
                text: 'La solicitud se ha procesado correctamente',
                icon: 'success'
              }).then(() => {
                // Recargar la página
                location.reload();
              });
            },
            error: function(jqXHR, textStatus, errorThrown) {
              // Mostrar una alerta de error utilizando SweetAlert2 con el mensaje de error recibido del servidor
              Swal.fire({
                title: 'Error',
                text: 'Ha ocurrido un error al procesar la solicitud: ' + jqXHR.responseText,
                icon: 'error'
              });
            }
          });
        } else {
          // Restaurar el valor original del select si se cancela la confirmación
          this.value = this.dataset.originalValue;
        }
      });
    });
  });

    // NUEVA ESTACION
    document.getElementById('form-nueva-estacion').addEventListener('submit', function(event) {
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
                // Mostrar alerta de éxito si la respuesta es exitosa
                Swal.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: '¡Datos actualizados correctamente!'
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

      //ELIMINAR ESTACION
    const btnEliminarEstacion = document.getElementsByClassName("btn-eliminar-estacion");

    // Recorrer los botones y agregar el evento de clic a cada uno
    for (let i = 0; i < btnEliminarEstacion.length; i++) {
    btnEliminarEstacion[i].addEventListener("click", function() {
        const id = this.getAttribute("data-id");
        console.log(id)

        // Mostrar SweetAlert2 para confirmar la eliminación del descuento
        Swal.fire({
        title: 'Confirmar eliminación',
        text: '¿Estás seguro de eliminar esta estacion de trabajo?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Eliminar',
        cancelButtonText: 'Cancelar'
        }).then((result) => {
        if (result.isConfirmed) {
            // Realizar la eliminación del descuento mediante una solicitud AJAX
            $.ajax({
            url: '/estacion/eliminar',
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            data: {
                idEstacion: id
            },
            success: function(response) {
                if (response.success) {
                // Eliminación exitosa, mostrar SweetAlert de éxito
                Swal.fire({
                    title: 'Éxito',
                    text: 'Estacion eliminada correctamente',
                    icon: 'success'
                }).then(() => {
                    // Ejemplo: Recargar la página después de eliminar el descuento
                    location.reload();
                });
                } else {
                // Error al eliminar el descuento, mostrar SweetAlert de error
                Swal.fire({
                    title: 'Error',
                    text: 'Error al eliminar estacion: ' + response.message,
                    icon: 'error'
                });
                }
            },
            error: function(xhr) {
                // Error al realizar la solicitud AJAX, mostrar SweetAlert de error
                Swal.fire({
                title: 'Error',
                text: 'Error al realizar la solicitud',
                icon: 'error'
                });
            }
            });
        }
        });
    });
    }
