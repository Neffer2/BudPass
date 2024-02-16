<div class="market-main-cont">

    <div class="premios-redenciones-cont">

        <div class="market-btn-cont">
            <button id="show-premios-btn" class="market-btn">Market</button>
            <button id="show-redenciones-btn" class="market-btn secundario-btn">Redenciones</button>
        </div>

        <div class="premios-cont">
            <div class="carousel-movil">
                @foreach ($premios->chunk(2) as $chunk)
                    <div class="carousel-page-movil">
                        @foreach ($chunk as $premio)
                            <div @class([
                                'premios-img-cont-movil' => true,
                                'disabled-premio' => $puntosUser < $premio->puntos,
                            ]) data-id="{{ $premio->id }}"
                                x-on:click="openModal({{ $premio->id }})">
                                <img src='{{ asset("assets/premios/$premio->foto") }}' height="50" alt="">
                            </div>
                        @endforeach
                    </div>
                @endforeach

                <div class="modal fade" id="premioModal" tabindex="-1" aria-labelledby="premioModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h2 class="modal-title" id="premioModalLabel"></h2>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <img id="premioModalImg" src="" alt="">
                                <p id="premioModalDesc"></p>
                                <p id="premioModalPuntos"></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" id="premioModalBtn">Redimir</button>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="carusel-btn-movil">
                    <button id="prev-carusel-movil"><i class="fas fa-arrow-left"></i></button>
                    <button id="next-carusel-movil"><i class="fas fa-arrow-right"></i></button>
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


    function openModal(id) {
        const premio = @json($premios).find(p => p.id === id);
        document.getElementById('premioModalLabel').textContent = premio.nombre;
        document.getElementById('premioModalImg').src = '{{ asset('assets/premios/') }}/' + premio.foto;
        document.getElementById('premioModalDesc').textContent = premio.descripcion;
        document.getElementById('premioModalPuntos').textContent = `Puntos requeridos: ${premio.puntos}`;

        const premioModalBtn = document.getElementById('premioModalBtn');
        if ({{ $puntosUser }} < premio.puntos) {
            premioModalBtn.textContent = 'No disponible';
            premioModalBtn.disabled = true;
        } else {
            premioModalBtn.textContent = 'Redimir';
            premioModalBtn.disabled = false;
            premioModalBtn.setAttribute('wire:click', `redimir(${premio.id})`);
        }

        $('#premioModal').modal('show');
    }
</script>
