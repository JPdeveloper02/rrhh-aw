$(document).ready(function () {
    $('.select_personal').select2({
    width: '100%',
    theme: "classic",
    placeholder: "Seleccione Persona",
    allowClear: true
    });
});

$(document).ready(function() {
$('.js-example-basic-multiple').select2();
});

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

