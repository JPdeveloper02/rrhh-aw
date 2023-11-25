//PASAR URL A FRAME PARA VISTA DE PREBOLETA
function setIframeSrc(url) {
    const iframe = document.getElementById('pdfIframe');
    const emailInput = document.getElementById('email');
    const urlInput = document.getElementById('url');
    const mensajeInput = document.getElementById('mensaje');
    const idPeriodoInput = document.getElementById('idPeriodo');
    const emailValue = event.target.dataset.email;
    const mensajeValue = event.target.dataset.mensaje;
    const idPeriodoValue = event.target.dataset.periodo;

    iframe.src = url;
    emailInput.value = emailValue;
    urlInput.value = url;
    mensajeInput.value = mensajeValue;
    idPeriodoInput.value = idPeriodoValue;

}

//ENVIO DE PREBOLETA AL SERVIDOR
document.querySelector('#formPreboleta').addEventListener('submit', function (event) {
    event.preventDefault(); // Evita que el formulario se envíe de forma predeterminada
    const formData = new FormData(this);

    // Realiza la solicitud AJAX utilizando Fetch
    fetch(this.action, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(function(data) {
        if (data.success) {
            // Mostrar alerta de éxito con un botón "Aceptar" y el ícono de un correo
            Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: '¡Correo enviado con éxito!',
                confirmButtonText: 'Aceptar',
                showClass: {
                    popup: 'swal2-noanimation',
                    backdrop: 'swal2-noanimation'
                },
                hideClass: {
                    popup: '',
                    backdrop: ''
                }
            }).then(function() {
                // Recargar la página
                location.reload();
            });
        } else {
            // Mostrar alerta de error con un botón "Aceptar" y el ícono de un correo
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: data.error,
                confirmButtonText: 'Aceptar',
                showClass: {
                    popup: 'swal2-noanimation',
                    backdrop: 'swal2-noanimation'
                },
                hideClass: {
                    popup: '',
                    backdrop: ''
                }
            });
        }
    })
    .catch(function(error) {
        console.log(error); 
        // Mostrar alerta de error si ocurre un error en la petición con un botón "Aceptar" y el ícono de un correo
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Ocurrió un problema al enviar la solicitud',
            confirmButtonText: 'Aceptar',
            showClass: {
                popup: 'swal2-noanimation',
                backdrop: 'swal2-noanimation'
            },
            hideClass: {
                popup: '',
                backdrop: ''
            }
        });
    });
});