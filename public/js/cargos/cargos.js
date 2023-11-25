    //PASAR DATOS A MODAL
    $(document).ready(function() {
        $('.editar-cargo').on('click', function() {
        var dataNombre = $(this).data('nombre');
        var dataId = $(this).data('id');
        
        // Hacer lo que necesites con los valores (por ejemplo, establecerlos en los campos correspondientes)
        $('#idCargo').val(dataId);
        $('#nombreCargo').val(dataNombre);
        });
    });

    //ELIMINAR CARGOS
    // Obtener todos los elementos con la clase "btn-eliminar-descuento"
    const btnEliminarCargo = document.getElementsByClassName("btn-eliminar-cargo");

    // Recorrer los botones y agregar el evento de clic a cada uno
    for (let i = 0; i < btnEliminarCargo.length; i++) {
    btnEliminarCargo[i].addEventListener("click", function() {
        const id = this.getAttribute("data-id");
        console.log(id)

        // Mostrar SweetAlert2 para confirmar la eliminación del descuento
        Swal.fire({
        title: 'Confirmar eliminación',
        text: '¿Estás seguro de eliminar este cargo?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Eliminar',
        cancelButtonText: 'Cancelar'
        }).then((result) => {
        if (result.isConfirmed) {
            // Realizar la eliminación del descuento mediante una solicitud AJAX
            $.ajax({
            url: '/eliminar/cargo',
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

        // NUEVO CARGO
        document.getElementById('form-nuevo-cargo').addEventListener('submit', function(event) {
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

    // EDICION DE NUEVO CARGO
    document.getElementById('form-editar-cargo').addEventListener('submit', function(event) {
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