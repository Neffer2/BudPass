<div class="market-main-cont">

    <div class="premios-redenciones-cont">

        <div class="market-btn-cont">
            <button id="show-premios-btn" class="market-btn">Market</button>
            <button id="show-redenciones-btn" class="market-btn secundario-btn">Redenciones</button>
        </div>

        <div class="premios-cont">
            <br>
            <div class="carousel-movil">
                @foreach ($premios->chunk(2) as $chunk)
                    <div class="carousel-page-movil">
                        @foreach ($chunk as $premio)
                            <div @class([
                                'premios-img-cont' => true,
                                'disabled-premio' => $puntosUser < $premio->puntos,
                            ])>
                                {{-- <h3>{{ $premio->nombre }}</h3> --}}
                                {{-- <p>{{ $premio->descripcion }} - Puntos: {{ $premio->puntos }}</p> --}}
                                <img src='{{ asset("assets/premios/$premio->foto") }}' height="50" alt="">
                                {{-- <button
                                    @if ($puntosUser >= $premio->puntos) class="disabled" x-on:click="$wire.redimir({{ $premio->id }})" @endif>
                                    @if ($puntosUser >= $premio->puntos)
                                        Redimir
                                    @else
                                        No disponible
                                    @endif
                                </button> --}}
                            </div>
                        @endforeach
                    </div>
                @endforeach
                <div class="carusel-btn-movil">
                    <button id="prev-carusel-movil">Prev</button>
                    <button id="next-carusel-movil">Next</button>
                </div>

            </div>

        </div>
        <div class="redenciones-premios-cont" style="background-color: aqua;">
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
                        <td>
                            @if ($redencion->estado_id)
                                Aprobado
                            @else
                                Rechazado
                            @endif
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

    <div class="market-destacados">
        @include('puntaje')
    </div>



    {{-- Alerta redimido --}}
    @if (session('success'))
        {{ session('success') }}
    @endif
</div>

<script>
    let index = 0;
    const pages = document.querySelectorAll('.carousel-page-movil');

    function showPage(index) {
        pages.forEach((page, i) => {
            page.style.display = i === index ? 'flex' : 'none';
        });
    }

    document.getElementById('prev-carusel-movil').addEventListener('click', () => {
        index = Math.max(0, index - 1);
        showPage(index);
    });

    document.getElementById('next-carusel-movil').addEventListener('click', () => {
        index = Math.min(pages.length - 1, index + 1);
        showPage(index);
    });

    showPage(index);
</script>
