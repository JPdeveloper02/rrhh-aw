

//Cambio de color al actualizar el Switch
document.getElementById('customSwitch1').addEventListener('change', function() {
    const horario = document.getElementById('horario')
    const spans = document.getElementsByClassName('span-cambio');
    for (const i = 0; i < spans.length; i++) {
        var span = spans[i];
        if (this.checked) {
            horario.value = 1;
            span.classList.remove('bg-primary');
            span.classList.add('bg-dark');
        } else {
            horario.value = 0;
            span.classList.remove('bg-dark');
            span.classList.add('bg-primary');
        }
    }
});
