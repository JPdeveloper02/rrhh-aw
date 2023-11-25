@if(session('success_fincontrato'))
<script>
  document.addEventListener('DOMContentLoaded', function() {
    Swal.fire({
      icon: 'success',
      title: 'Registro exitoso!',
      text: '{{ session('success_fincontrato') }}',
      showConfirmButton: false,
      timer: 3000
    });
  });
</script>
@endif

@if(session('error_fincontrato'))
<script>
  document.addEventListener('DOMContentLoaded', function() {
    Swal.fire({
      icon: 'error',
      title: 'Error!',
      text: '{{ session('error_fincontrato') }}',
      showConfirmButton: false,
      timer: 3000
    });
  });
</script>
@endif

@if(session('success_cesecontrato'))
<script>
  document.addEventListener('DOMContentLoaded', function() {
    Swal.fire({
      icon: 'success',
      title: 'Registro exitoso!',
      text: '{{ session('success_cesecontrato') }}',
      showConfirmButton: false,
      timer: 3000
    });
  });
</script>
@endif

@if(session('error_cesecontrato'))
<script>
  document.addEventListener('DOMContentLoaded', function() {
    Swal.fire({
      icon: 'error',
      title: 'Error!',
      text: '{{ session('error_cesecontrato') }}',
      showConfirmButton: false,
      timer: 3000
    });
  });
</script>
@endif