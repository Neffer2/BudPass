<div>
    @foreach ($premios as $premio)
        <div @class(['disabled' => $puntosUser < $premio->puntos])>
            <h3>{{ $premio->nombre }}</h3>
            <p>{{ $premio->descripcion }} - Puntos: {{ $premio->puntos }}</p>
            
            <img src='{{ asset("assets/premios/$premio->foto") }}' height="50" alt="">
            <button @if ($puntosUser >= $premio->puntos) class="disabled" x-on:click="$wire.redimir({{ $premio->id }})" @endif>
                @if ($puntosUser >= $premio->puntos) Redimir @else No disponible @endif
            </button>                
        </div>
        <br>
    @endforeach

    <div style="background-color: aqua">
        <h2>Tus redenciones</h2>    
        <table>
            <tr>
                <td>Premio</td> 
                <td>Puntos</td>
                <td>Fecha</td>
                <td>Estado</td>
            </tr>
            @foreach ($user->redenciones as $redencion)
                <tr>
                    <td>{{ $redencion->premio->nombre }}</td>
                    <td>{{ $redencion->premio->puntos }}</td>
                    <td>{{ $redencion->created_at }}</td>
                    <td>@if ($redencion->estado_id) Aprobado @else Rechazado @endif</td>
                </tr>
            @endforeach
        </table>
    </div>
    @if (session('success'))
        {{ session('success') }}
    @endif
</div>
 