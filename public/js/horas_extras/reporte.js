// Obtener todos los elementos con la clase "btn-eliminar-descuento"
const btnEliminarHoraExtra = document.getElementsByClassName("btn-eliminar-horasextras");

// Recorrer los botones y agregar el evento de clic a cada uno
for (let i = 0; i < btnEliminarHoraExtra.length; i++) {
    btnEliminarHoraExtra[i].addEventListener("click", function() {
    const id = this.getAttribute("data-id");

    // Mostrar SweetAlert2 para confirmar la eliminación del descuento
    Swal.fire({
      title: 'Confirmar eliminación',
      text: '¿Estás seguro de eliminar esta hora extra?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Eliminar',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        // Realizar la eliminación del descuento mediante una solicitud AJAX
        $.ajax({
          url: '/horasextras/eliminar',
          type: 'POST',
          headers: {
            'X-CSRF-TOKEN': csrfToken
          },
          data: {
            id: id
          },
          success: function(response) {
            if (response.success) {
              // Eliminación exitosa, mostrar SweetAlert de éxito
              Swal.fire({
                title: 'Éxito',
                text: 'Descuento eliminado correctamente',
                icon: 'success'
              }).then(() => {
                // Ejemplo: Recargar la página después de eliminar el descuento
                location.reload();
              });
            } else {
              // Error al eliminar el descuento, mostrar SweetAlert de error
              Swal.fire({ 
                title: 'Error',
                text: 'Error al eliminar el descuento: ' + response.message,
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

//Abrir modales de tareo individual
function openModalIndividual(select) {
  const modalTarget = select.getAttribute('data-modal-target');
  const selectedOption = select.value;
  const selectedText = select.options[select.selectedIndex].text;

  if (modalTarget) {
      const inputContrato = document.getElementById('idContrato');
      if (inputContrato) {
          inputContrato.value = selectedOption;
      }

      const modalTitle = document.querySelector(`${modalTarget} .modal-title`);
      if (modalTitle) {
          modalTitle.textContent = `Registro para ${selectedText}`;
      }

      $(modalTarget).modal('show');
  }
}

function openModalHE(select) {
  const modalTarget = select.getAttribute('data-modal-target');
  const selectedOption = select.value;
  const selectedText = select.options[select.selectedIndex].text;

  if (modalTarget) {
      const inputContrato = document.getElementById('idContratoHE');
      if (inputContrato) {
          inputContrato.value = selectedOption;
      }

      const modalTitle = document.querySelector(`${modalTarget} .modal-title`);
      if (modalTitle) {
          modalTitle.textContent = `Registro para ${selectedText}`;
      }

      $(modalTarget).modal('show');
  }
}

