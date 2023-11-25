 // Manejar el envío del formulario por AJAX
 document.getElementById('form_nuevo_contrato').addEventListener('submit', function(event) {
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
                text: '¡Persona registrada con éxito!'
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