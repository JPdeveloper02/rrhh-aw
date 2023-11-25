
//INICIALIZANDO SELECT2
$(document).ready(function () {
    $('.select_personal').select2({
    width: '100%',
    theme: "classic",
    placeholder: "Seleccione Persona",
    allowClear: true
    });
});

//ABRIR EL MODAL CON EL ID CONTRATO
function openModalDescuentos(select) {
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
            modalTitle.textContent = `Registro para: ${selectedText}`;
        }

        $(modalTarget).modal('show');
    }
}

//INPUTS A MOSTRAR DE ACUERDO A SELECT DE OPCIONES
document.getElementById('select-descuento').addEventListener('change', function() {
    const selectedValue = this.value;

    const divMonto = document.getElementById('div-monto');
    const divCuotas = document.getElementById('div-cuotas');
    const divTabla = document.getElementById('div-tabla');
    const divDocumento = document.getElementById('div-motivo');
    const divMotivo = document.getElementById('div-documento');

    if (selectedValue === '2') {
        divDocumento.style.display= 'none';
        divMotivo.style.display = 'none';
        divMonto.style.display = 'none';
        divTabla.style.display = 'block';
        divCuotas.style.display = 'block';
    } else if(selectedValue === '1'){
        divDocumento.style.display= 'none';
        divMotivo.style.display = 'block';
        divMonto.style.display = 'block';
        divTabla.style.display = 'none';
        divCuotas.style.display = 'none';
    } else{
        divDocumento.style.display= 'block';
        divMotivo.style.display = 'block';
        divMonto.style.display = 'block';
        divTabla.style.display = 'none';
        divCuotas.style.display = 'none';
    }   
});

//CRONOGRAMA DE PRESTAMOS
document.getElementById('input_cuotas').addEventListener('input', function() {
    var cuotas = parseInt(this.value);

    var tabla = document.getElementById('tabla-prestamos');
    var tbody = tabla.getElementsByTagName('tbody')[0];

    // Eliminar filas existentes
    while (tbody.firstChild) {
        tbody.removeChild(tbody.firstChild);
    }

    // Obtener la fecha inicial del input "fecha"
    var fechaInicial = document.getElementById('fecha').value;
    var fecha = fechaInicial ? new Date(fechaInicial) : null;

    // Generar filas nuevas
    for (var i = 1; i <= cuotas; i++) {
        var tr = document.createElement('tr');

        var tdNumero = document.createElement('td');
        tdNumero.textContent = i;
        tr.appendChild(tdNumero);

        var tdFecha = document.createElement('td');
        tdFecha.contentEditable = "true"; // Columna editable

        // Establecer la fecha en el formato deseado (dd/mm/yyyy) si hay un valor
        if (fecha) {
            var dia = fecha.getDate() + 1;
            var mes = fecha.getMonth() + 1; // Los meses en JavaScript son base 0
            var año = fecha.getFullYear();
            tdFecha.textContent = dia + '/' + mes + '/' + año;
        }
        
        tr.appendChild(tdFecha);

        var tdMonto = document.createElement('td');
        tdMonto.contentEditable = "true"; // Columna editable
        tdMonto.textContent = '';
        tr.appendChild(tdMonto);

        tbody.appendChild(tr);

        // Avanzar la fecha al siguiente mes si hay un valor
        if (fecha) {
            fecha.setMonth(fecha.getMonth() + 1);
        }
    }

    // Agregar fila para el total de montos
    var trTotal = document.createElement('tr');

    var tdVacio1 = document.createElement('td');
    tdVacio1.textContent = '';
    trTotal.appendChild(tdVacio1);

    var tdVacio2 = document.createElement('td');
    tdVacio2.textContent = 'Total Monto';
    trTotal.appendChild(tdVacio2);

    var tdTotal = document.createElement('td');
    tdTotal.textContent = '';
    trTotal.appendChild(tdTotal);

    tbody.appendChild(trTotal);

    // Actualizar el total de los montos al modificar los valores
    var montos = tabla.querySelectorAll('tbody tr:not(:last-child) td:last-child');
    var totalMontos = 0; // Variable para almacenar el total de los montos

    for (var j = 0; j < montos.length; j++) {
        montos[j].addEventListener('input', function() {
            if (this.textContent) {
                var monto = parseFloat(this.textContent);
                if (!isNaN(monto)) {
                    totalMontos = 0; // Reiniciar el total de montos
                    montos.forEach(function(td) {
                        if (td.textContent) {
                            var montoActual = parseFloat(td.textContent);
                            if (!isNaN(montoActual)) {
                                totalMontos += montoActual;
                            }
                        }
                    });
                    tdTotal.textContent = totalMontos.toFixed(2);
                }
            }
        });

        montos[j].addEventListener('focus', function() {
            if (this.textContent) {
                var monto = parseFloat(this.textContent);
                if (!isNaN(monto)) {
                    this.setAttribute('data-monto', monto);
                }
            }
        });

        montos[j].addEventListener('blur', function() {
            this.removeAttribute('data-monto');
        });
    }
});

//ENVIO DE FORMULARIO
document.getElementById('form-registro-descuento').addEventListener('submit', function(event) {
    event.preventDefault(); // Evitar que el formulario se envíe de forma predeterminada

    // Obtener todos los datos del formulario
    var formData = new FormData(this);

    // Obtener los datos de la tabla
    var tabla = document.getElementById('tabla-prestamos');
    var filas = tabla.getElementsByTagName('tr');

    // Crear un array para almacenar los datos de la tabla
    var datosTabla = [];

    // Recorrer las filas de la tabla (excepto la primera y la última)
    for (var i = 1; i < filas.length - 1; i++) {
        var fila = filas[i];
        var celdas = fila.getElementsByTagName('td');
    
        // Verificar si las celdas existen antes de acceder a las propiedades
        if (celdas.length >= 3) {
            // Obtener los valores de las celdas
            var numero = celdas[0].textContent;
            var fecha = celdas[1].textContent;
            var monto = celdas[2].textContent;
    
            // Crear un objeto con los valores de la fila
            var datosFila = {
                numero: numero,
                fecha: fecha,
                monto: monto
            };
    
            // Agregar el objeto al array
            datosTabla.push(datosFila);
        }
    }

    // Agregar los datos de la tabla al FormData
    formData.append('datosTabla', JSON.stringify(datosTabla));

    // Realizar la solicitud HTTP con Fetch
    fetch(this.action, {
        method: this.method,
        body: formData
    })
    .then(function(response) {
        // Verificar el estado de la respuesta
        if (response.ok) {
            return response.json();
        } else {
            throw new Error('Error en la solicitud');
        }
    })
    .then(function(data) {
        // Verificar la respuesta del servidor
        if (data.success) {
            // Mostrar Sweet Alert de éxito
            Swal.fire('¡Éxito!', data.message, 'success').then(function() {
                // Cerrar el modal
                $('#registro_descuentos').modal('hide').on('hidden.bs.modal', function () {
                    $(this).find('form').trigger('reset');
                });
            });
        } else {
            // Mostrar Sweet Alert de error
            Swal.fire('¡Error!', data.message, 'error');
        }
    })
    .catch(function(error) {
        // Mostrar Sweet Alert de error en caso de error en la solicitud
        Swal.fire('¡Error!', error.message, 'error');
    });
});