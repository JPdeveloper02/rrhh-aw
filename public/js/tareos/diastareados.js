$(document).ready(function(){

    //LLENAR FORMULARIO CON DATOS PARA EL TAREO
    $('.btn-tareo').on('click', function(){
        //SI TIENE TAREO
        if($(this).data('tareo')){
            let idTareo = $(this).data('tareo')
            //console.log(idTareo)
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });

            $.ajax({
                url: buscarTareoId,
                method: 'POST',
                data: {'idtareo': idTareo},
                success: function(rpta){
                    $('#btnEliminarTareo').show();
                    $('#formTareo input[name="tareo"]').val(rpta.idTareo).hide()
                    $('#formTareo input[name="contrato"]').val('').hide()
                    $('#formTareo select[name="estacion"] option[value="'+ rpta.idEstacionDeTrabajo +'"]').prop('selected', true)
                    $('#formTareo select[name="condicionTareo"] option[value="'+ rpta.idCondicionDeTareo +'"]').prop('selected', true)
                    $('#formTareo input[name="fecha"]').val(moment(rpta.Fecha).utcOffset(0).format('YYYY-MM-DD'))
                    let hora = moment.utc(rpta.HoraDeIngreso).utcOffset(0)
                    $('#formTareo input[name="horaIngreso"]').val(hora.format('HH:mm'))
                    hora = moment.utc(rpta.HoraDeInicioDeAlmuerzo).utcOffset(0)
                    $('#formTareo input[name="inicioAlmuerzo"]').val(hora.format('HH:mm'))
                    hora = moment.utc(rpta.HoraDeFinDeAlmuerzo).utcOffset(0)
                    $('#formTareo input[name="finAlmuerzo"]').val(hora.format('HH:mm'))
                    hora = moment.utc(rpta.HoraDeSalida).utcOffset(0)
                    $('#formTareo input[name="horaSalida"]').val(hora.format('HH:mm'))

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
            })
        }        
        //NO TIENE TAREO
        else if($(this).data('contrato')){
            //LIMPIAMOS LOS INPUTS
            $('#btnEliminarTareo').hide();
            $('#formTareo input[name="tareo"]').val('').hide()
            $('#formTareo input[name="contrato"]').val('')
            $('#formTareo select option[value=""]').prop('selected', true)
            $('#formTareo input[name="horaIngreso"]').val('')
            $('#formTareo input[name="inicioAlmuerzo"]').val('')
            $('#formTareo input[name="finAlmuerzo"]').val('')
            $('#formTareo input[name="horaSalida"]').val('')

            let contrato = $(this).data('contrato')
            let fecha = $(this).data('fecha')

            $('#formTareo input[name="contrato"]').val(contrato).hide()
            $('#formTareo input[name="fecha"]').val(fecha)
        }
        
    });

    $('#btnGuardarTareo').on('click', function(){
        const form = $('#formTareo').serialize()
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });

        $.ajax({
            url: guardarEditarTareo,
            method: 'POST',
            data: form,
            success: function(rpta){
                Swal.fire({
                    title: 'EXITO',
                    text: rpta.mensaje,
                    icon: 'success',
                    confirmButtonText: 'ACEPTAR'
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
                    icon: 'warning',
                    confirmButtonText: 'Aceptar'
                });
            }
        })
    })

    //ELIMINAR TAREO
    $('#btnEliminarTareo').on('click', function(){
        const idTareo = $('#tareo').val(); // Obtener el valor del campo de entrada con el ID "idTareo"
        console.log(idTareo);
    
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });
    
        $.ajax({
            url: eliminarTareo,
            method: 'POST',
            data: {
                idTareo: idTareo // Incluir el valor del campo de entrada en los datos enviados
            },
            success: function(rpta){
                Swal.fire({
                    title: 'EXITO',
                    text: rpta.mensaje,
                    icon: 'success',
                    confirmButtonText: 'ACEPTAR'
                }).then(function(){
                    location.reload();
                });
            },
            error: function(xhr, status, error){
                const errorMessage = xhr.responseText; // Obtener el mensaje de error del servidor
                const errorObj = JSON.parse(errorMessage);
    
                Swal.fire({
                    title: 'ERROR',
                    text: errorObj.error,
                    icon: 'warning',
                    confirmButtonText: 'Aceptar'
                });
            }
        });
    });

})

$(document).ready(function() {
    // Manejar el evento de cambio del select de estación de trabajo
    $('select[name="estacion"]').on('change', function() {
        const selectedValue = $(this).val();

        // Actualizar los valores de los campos de entrada según el valor seleccionado
        if (selectedValue === '1' || selectedValue === '2') {
            $('input[name="horaIngreso"]').val('08:00');
            $('input[name="inicioAlmuerzo"]').val('13:00');
            $('input[name="finAlmuerzo"]').val('14:00');
            $('input[name="horaSalida"]').val('17:15');
        } else  if (selectedValue === '2') {
            $('input[name="horaIngreso"]').val('07:30');
            $('input[name="inicioAlmuerzo"]').val('13:00');
            $('input[name="finAlmuerzo"]').val('14:00');
            $('input[name="horaSalida"]').val('16:45');
        } else  if (selectedValue === '4' || selectedValue === '5' || selectedValue === '6' || selectedValue === '7' || selectedValue === '8') {
            $('input[name="horaIngreso"]').val('0:30');
            $('input[name="inicioAlmuerzo"]').val('13:00');
            $('input[name="finAlmuerzo"]').val('14:00');
            $('input[name="horaSalida"]').val('16:45');
        }else{
            $('input[name="horaIngreso"]').val('08:00');
            $('input[name="inicioAlmuerzo"]').val('13:00');
            $('input[name="finAlmuerzo"]').val('14:00');
            $('input[name="horaSalida"]').val('17:15');
        }
    });
});