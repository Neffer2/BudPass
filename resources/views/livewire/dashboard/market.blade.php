<div>
    @foreach ($premios as $premio)
        <div @class(['disabled' => $puntosUser < $premio->puntos])>
            <h3>{{ $premio->nombre }}</h3>
            <p>{{ $premio->descripcion }} - Puntos: {{ $premio->puntos }}</p>
            
            <button @if ($puntosUser >= $premio->puntos) class="disabled" x-on:click="$wire.redimir({{ $premio->id }})" @endif>
                @if ($puntosUser >= $premio->puntos) Redimir @else No disponible @endif
            </button>                
        </div>
        <br>
    @endforeach
    @if (session('success'))
        {{ session('success') }}
    @endif
</div>
