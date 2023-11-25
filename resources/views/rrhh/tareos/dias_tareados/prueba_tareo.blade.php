<div>
    @if (!empty($foto))
    <img src="{{ asset('storage').'/'.$foto->img_prueba_tareo }}" alt="">
    @else
    <img src="https://img.freepik.com/vector-premium/no-hay-foto-disponible-icono-vector-simbolo-imagen-predeterminado-imagen-proximamente-sitio-web-o-aplicacion-movil_87543-10615.jpg?size=626&ext=jpg&ga=GA1.1.386372595.1697673600&semt=ais" alt="">
    @endif
   
</div>