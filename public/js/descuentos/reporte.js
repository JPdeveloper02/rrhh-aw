// Obtener todos los elementos con la clase "btn-eliminar-descuento"
const btnEliminarDescuento = document.getElementsByClassName("btn-eliminar-descuento");

// Recorrer los botones y agregar el evento de clic a cada uno
for (let i = 0; i < btnEliminarDescuento.length; i++) {
  btnEliminarDescuento[i].addEventListener("click", function() {
    const option = this.getAttribute("data-option");
    const id = this.getAttribute("data-id");
    console.log(option+"--"+id)

    // Mostrar SweetAlert2 para confirmar la eliminación del descuento
    Swal.fire({
      title: 'Confirmar eliminación',
      text: '¿Estás seguro de eliminar este descuento?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Eliminar',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        // Realizar la eliminación del descuento mediante una solicitud AJAX
        $.ajax({
          url: '/descuentos/eliminar',
          type: 'POST',
          headers: {
            'X-CSRF-TOKEN': csrfToken
          },
          data: {
            option: option,
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