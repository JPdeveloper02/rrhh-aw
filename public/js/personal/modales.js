//FUNCION PARA CONTROLAR ACCIONES DEL SELECT DE PERSONAL
function openModal(select) {
    const selectedOption = select.value;
    const modalTarget = select.options[select.selectedIndex].getAttribute('data-modal-target');
    const idContrato = select.getAttribute('data-id-contrato');
    const selectedText = select.options[select.selectedIndex].text;

    if (selectedOption === 'contrato') {
        // Realizar redirección a la página de contrato
        window.location.href = 'personal/contrato/' + idContrato;
    } else if (modalTarget) {
        let inputContrato;

        if (modalTarget === '#descanso_medico') {
            inputContrato = document.getElementById('idContratoInput1');
        } else if (modalTarget === '#licencia_goce') {
            inputContrato = document.getElementById('idContratoInput2');
        } else if (modalTarget === '#licencia_singoce') {
            inputContrato = document.getElementById('idContratoInput3');
        } else if (modalTarget === '#otros_documentos') {
            inputContrato = document.getElementById('idContratoInput4');
            const option = document.getElementById('tipo_documento');
            const title = document.getElementById('title');
            const comentario = document.getElementById('comentario');

            option.value = selectedOption;
            title.innerHTML = selectedText;
            
            if (selectedOption == 10) {
                comentario.style.display = "block";
            } else {
                comentario.style.display = "none";
            }
        }

        if (inputContrato) {
            inputContrato.value = idContrato;
        }

        $(modalTarget).modal('show');

        // Reiniciar el valor seleccionado después de cerrar el modal
        $(modalTarget).on('hidden.bs.modal', function () {
            select.value = ""; // Establecer el valor como una cadena vacía
        });
    }
}


//ENVIO DE DOCUMENTOS A CONTROLADOR CON AJAX
$(document).ready(function(){

    $('#tabla-Empleados').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
        },
    });

    //IDEmpleado en MODAL para Subir DOC CONTRATO
    $('.btn[data-empleado]').click(function(){
        const empleadoId = $(this).data('empleado');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });

        $.ajax({
            url: verPersonaUrl,
            method: 'POST',
            data: { idEmpleado:empleadoId },
            success: function(rpta){
                const nombres = (rpta.ApellidoPaterno+' '+rpta.ApellidoMaterno+' '+rpta.Nombres).toUpperCase();
                $('#datoPersonaNombres').val(nombres);
                $('#Cargo').val(rpta.NombreCargo);
                $('#contratoInicio').val(rpta.FechaDeInicioDeContrato);
                $('#contratoFin').val(rpta.FechaDeFinDeContrato);
                $('#contratoEmpresa').val(rpta.empresa);

                $('#idEmpleadoContra').val(empleadoId);
                console.log(nombres, rpta.NombreCargo);
            }
        })
        
    });

    //EVALUAR ARCHIVO PDF
    $('#formFile').on('change', function(){
        const archivo = $(this)[0].files[0];
        const extension = archivo.name.split('.').pop().toLowerCase();

        if (extension !== 'pdf') {
            $('#errorMessage').text('Por favor, sube un archivo PDF.');
        } else {
            $('#errorMessage').text('');
        }
    });

    //GUARDAR DOCUMENTO CONTRATO
    $('#btnGuardar').click(function(event){
        event.preventDefault();

        const formData = new FormData( $('#guardarContratoDoc')[0]);
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });

        $.ajax({
            url: guardarContrato,
            method: 'POST',
            data: formData,
            contentType: false, //Cuando envias por formData se coloca esto
            processData: false, //Cuando envias por formData se coloca esto
            success: function(rpta){
                Swal.fire({
                    title: 'EXITO',
                    text: rpta.mensaje,
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                }).then(function(){
                    location.reload();
                });


            },
            error: function(xhr, status, error){
                const errorMessage = xhr.responseText; // Obtener el mensaje de error del servidor
                const errorObj = JSON.parse(errorMessage);
                console.log(errorObj.error);
                
                Swal.fire({
                    title: 'ATENCION',
                    text: errorObj.error,
                    icon: 'warning',
                    confirmButtonText: 'Aceptar'
                });
                
            }
        });

    });

    //DESCANSO MEDICO MODAL
    $('#btnGuardarDescansoMedico').click(function(event){
        event.preventDefault();

        const formData = new FormData($('#descansoMedico')[0]);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        })

        $.ajax({
            url: descansoMedico,
            method: 'POST',
            data: formData,
            contentType: false, //Cuando envias por formData se coloca esto
            processData: false, //Cuando envias por formData se coloca esto
            success: function(rpta){
                Swal.fire({
                    title: 'EXITO',
                    text: rpta.mensaje,
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                }).then(function(){
                    location.reload();
                });
            },
            error: function(xhr, status, error){
                const errorMessage = xhr.responseText; // Obtener el mensaje de error del servidor
                const errorObj = JSON.parse(errorMessage);
                
                Swal.fire({
                    title: 'ATENCION',
                    text: errorObj.error,
                    icon: 'error',
                    confirmButtonText: 'Aceptar'
                });
                
            }
        });
    });

    //LICENCIA CON GOCE
    $('#btnLicenciaConGoce').click(function(event){
        event.preventDefault();

        const formData = new FormData($('#licenciaConGoce')[0]);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        })

        $.ajax({
            url: licenciaConGoce,
            method: 'POST',
            data: formData,
            contentType: false, //Cuando envias por formData se coloca esto
            processData: false, //Cuando envias por formData se coloca esto
            success: function(rpta){
                Swal.fire({
                    title: 'EXITO',
                    text: rpta.mensaje,
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                }).then(function(){
                    location.reload();
                });
            },
            error: function(xhr, status, error){
                const errorMessage = xhr.responseText; // Obtener el mensaje de error del servidor
                const errorObj = JSON.parse(errorMessage);
                
                Swal.fire({
                    title: 'ATENCION',
                    text: errorObj.error,
                    icon: 'error',
                    confirmButtonText: 'Aceptar'
                });
                
            }
        });
    });

    //LICENCIA SIN GOCE
    $('#btnLicenciaSinGoce').click(function(event){
        event.preventDefault();

        const formData = new FormData($('#licenciaSinGoce')[0]);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        })

        $.ajax({
            url: licenciaSinGoce,
            method: 'POST',
            data: formData,
            contentType: false, //Cuando envias por formData se coloca esto
            processData: false, //Cuando envias por formData se coloca esto
            success: function(rpta){
                Swal.fire({
                    title: 'EXITO',
                    text: rpta.mensaje,
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                }).then(function(){
                    location.reload();
                });
            },
            error: function(xhr, status, error){
                const errorMessage = xhr.responseText; // Obtener el mensaje de error del servidor
                const errorObj = JSON.parse(errorMessage);
                
                Swal.fire({
                    title: 'ATENCION',
                    text: errorObj.error,
                    icon: 'error',
                    confirmButtonText: 'Aceptar'
                });
                
            }
        });
    });


     //OTROS DOCUMENTOS
     $('#btnOtrosDocumentos').click(function(event){
        event.preventDefault();

        const formData = new FormData($('#form_otros')[0]);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        })
        $.ajax({
            url: otrosDocumentos,
            method: 'POST',
            data: formData,
            contentType: false, //Cuando envias por formData se coloca esto
            processData: false, //Cuando envias por formData se coloca esto
            success: function(rpta){
                Swal.fire({
                    title: 'EXITO',
                    text: rpta.mensaje,
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                }).then(function(){
                    location.reload();
                });
            },
            error: function(xhr, status, error){
                const errorMessage = xhr.responseText; // Obtener el mensaje de error del servidor
                const errorObj = JSON.parse(errorMessage);
                
                Swal.fire({
                    title: 'ATENCION',
                    text: errorObj.error,
                    icon: 'error',
                    confirmButtonText: 'Aceptar'
                });
                
            }
        });
    });


        //SUBIR CONTRATO DESDE PERFIL
        $(document).ready(function() {
            $('.btnPerfilContratoOpen').on('click', function(event) {
                event.preventDefault(); // Evitar el comportamiento predeterminado del evento click
                var idContrato = $(this).data('idcontrato');
                $('#idContratoPerfil').val(idContrato);
                console.log(idContrato)
            });
        
            $('#btnPerfilContrato').click(function(event) {
                event.preventDefault(); // Evitar el comportamiento predeterminado del evento click
                
                
                const formData = new FormData($('#pefilContrato')[0]);
            
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    }
                });
            
                $.ajax({
                    url: '/perfil/subir/contrato',
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(rpta) {
                        Swal.fire({
                            title: 'EXITO',
                            text: rpta.mensaje,
                            icon: 'success',
                            confirmButtonText: 'Aceptar'
                        }).then(function() {
                            location.reload();
                        });
                    },
                    error: function(xhr, status, error) {
                        const errorMessage = xhr.responseText;
                        const errorObj = JSON.parse(errorMessage);
                        
                        Swal.fire({
                            title: 'ATENCION',
                            text: errorObj.error,
                            icon: 'error',
                            confirmButtonText: 'Aceptar'
                        });
                    }
                });
            });
        });


        //ELIMINAR DOCUMENTO DE CONTRATO
    // Obtener todos los elementos con la clase "btn-eliminar-descuento"
    const btnEliminarDocumento = document.getElementsByClassName("btn-eliminar-documento");

    // Recorrer los botones y agregar el evento de clic a cada uno
    for (let i = 0; i < btnEliminarDocumento.length; i++) {
        btnEliminarDocumento[i].addEventListener("click", function() {
        const id = this.getAttribute("data-idcontrato");
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
            url: '/perfil/eliminar/contrato',
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
                    text: 'Documento eliminado correctamente',
                    icon: 'success'
                }).then(() => {
                    // Ejemplo: Recargar la página después de eliminar el descuento
                    location.reload();
                });
                } else {
                // Error al eliminar el descuento, mostrar SweetAlert de error
                Swal.fire({
                    title: 'Error',
                    text: 'Error al eliminar el documento: ' + response.message,
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


     //EDITAR FECHAS DE CONTRATO
     $(document).ready(function() {
        $('.btnPerfilEditarFechas').on('click', function(event) {
            event.preventDefault(); // Evitar el comportamiento predeterminado del evento click
            var idContrato = $(this).data('idcontrato');
            var fecha_inicio = $(this).data('fi');
            var fecha_fin = $(this).data('ff');

            $('#idContratoPerfilFecha').val(idContrato);
            $('#fecha_inicio_fechas').val(fecha_inicio);    
            $('#fecha_fin_fechas').val(fecha_fin);
        });
    
        $('#btnPerfilEFecha').click(function(event) {
            event.preventDefault(); // Evitar el comportamiento predeterminado del evento click
            
            
            const formData = new FormData($('#pefilEditarFecha')[0]);
        
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });
        
            $.ajax({
                url: '/perfil/editar/fecha',
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(rpta) {
                    Swal.fire({
                        title: 'EXITO',
                        text: rpta.mensaje,
                        icon: 'success',
                        confirmButtonText: 'Aceptar'
                    }).then(function() {
                        location.reload();
                    });
                },
                error: function(xhr, status, error) {
                    const errorMessage = xhr.responseText;
                    const errorObj = JSON.parse(errorMessage);
                    
                    Swal.fire({
                        title: 'ATENCION',
                        text: errorObj.error,
                        icon: 'error',
                        confirmButtonText: 'Aceptar'
                    });
                }
            });
        });
    });


});