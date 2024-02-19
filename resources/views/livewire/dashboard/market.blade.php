<div class="market-main-cont">

    <div class="main-premios-redenciones-cont">

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

                <div class="modal fade custom-modal" id="premioModal" tabindex="-1" aria-labelledby="premioModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body custom-modal-body">
                                <h2 class="modal-title custom-modal-title" id="premioModalLabel"></h2>
                                <button type="button" class="close custom-close" data-dismiss="modal"
                                    aria-label="Close">
                                    <img src="{{ asset('assets/budweiser/icono-cerrar-popup.svg') }}"
                                        aria-hidden="true">
                                </button>
                                <div class="modal-img-custom">
                                    <img id="premioModalImg" src="" alt="" class="custom-modal-img">
                                </div>
                                <p id="premioModalDesc" class="custom-modal-desc"></p>
                                <p id="premioModalPuntos" class="custom-modal-puntos"></p>
                                <div class="btn-modal-premios">
                                    <button type="button" class="btn-modal-premios-redimir"
                                        id="premioModalBtn">Redimir</button>
                                    <button type="button" class="btn-modal-premios-close"
                                        data-dismiss="modal">Cerrar</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="pagination-dots-movil"></div>
                {{-- <div class="carusel-btn-movil">
                    <button id="prev-carusel-movil"><i class="fas fa-arrow-left"></i></button>
                    <button id="next-carusel-movil"><i class="fas fa-arrow-right"></i></button>
                </div> --}}

            </div>

            <div class="carousel-desktop">

                <div class="carousel-destacados-desk">
                    <div class="destacado-left">
                    </div>
                    <div class="destacado-right"></div>
                </div>

                @foreach ($premios->chunk(4) as $chunk)
                    <div class="carousel-page-desktop">
                        @foreach ($chunk as $premio)
                            <div @class([
                                'premios-img-cont-desktop' => true,
                                'disabled-premio' => $puntosUser < $premio->puntos,
                            ]) data-id="{{ $premio->id }}"
                                x-on:click="openModalDesktop({{ $premio->id }})"
                                x-on:mouseover="showDescription({{ $premio->id }})"
                                x-on:mouseout="hideDescription({{ $premio->id }})">
                                <img src='{{ asset("assets/premios/$premio->foto") }}' height="50" alt="">
                                <div class="product-description" id="description-{{ $premio->id }}">
                                    {{ $premio->descripcion }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach

                <div class="modal fade custom-modal" id="premioModalDesktop" tabindex="-1"
                    aria-labelledby="premioModalLabelDesktop" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body custom-modal-body">
                                <h2 class="modal-title custom-modal-title" id="premioModalLabelDesktop"></h2>
                                <button type="button" class="close custom-close" data-dismiss="modal"
                                    aria-label="Close">
                                    <img src="{{ asset('assets/budweiser/icono-cerrar-popup.svg') }}"
                                        aria-hidden="true">
                                </button>
                                <div class="modal-img-custom">
                                    <img id="premioModalImgDesktop" src="" alt=""
                                        class="custom-modal-img">
                                </div>
                                <p id="premioModalDescDesktop" class="custom-modal-desc"></p>
                                <p id="premioModalPuntosDesktop" class="custom-modal-puntos"></p>
                                <div class="btn-modal-premios">
                                    <button type="button" class="btn-modal-premios-redimir"
                                        id="premioModalBtnDesktop">Redimir</button>
                                    <button type="button" class="btn-modal-premios-close"
                                        data-dismiss="modal">Cerrar</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="carousel-btn-desktop">
                    <div class="pagination-dots"></div>
                    <div class="carousel-btn-desk-cont">
                        <button id="prev-carousel-desktop"><i class="fas fa-arrow-left"></i></button>
                        <button id="next-carousel-desktop"><i class="fas fa-arrow-right"></i></button>
                    </div>
                </div>



            </div>

        </div>
        <div class="redenciones-premios-cont">
            <h2>Tus redenciones</h2>
            <table>
                <tr>
                    <th>Premio</td>
                    <th>Puntos</th>
                    <th>Fecha</th>
                </tr>
                @foreach ($user->redenciones as $redencion)
                    <tr>
                        <td>{{ $redencion->premio->nombre }}</td>
                        <td>{{ $redencion->premio->puntos }}</td>
                        <td>{{ $redencion->created_at }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

    <div class="market-destacados">
        @include('puntaje')
    </div>

</div>

<script>
    let index = 0;
    let indexDesktop = 0;
    let touchStartX = 0;
    let touchEndX = 0;
    let touchStartY = 0;
    let touchEndY = 0;
    const carouselMovil = document.querySelector('.carousel-movil');
    const pages = document.querySelectorAll('.carousel-page-movil');
    const pagesDesktop = document.querySelectorAll('.carousel-page-desktop');
    const paginationDotsContainer = document.querySelector('.pagination-dots');
    const paginationDotsContainerMovil = document.querySelector('.pagination-dots-movil');


    function showPage(index) {
        pages.forEach((page, i) => {
            page.style.display = i === index ? 'flex' : 'none';
        });
    }

    showPage(index);


    // Eventos touch para market movil
    carouselMovil.addEventListener('touchstart', (event) => {
        touchStartX = event.changedTouches[0].screenX;
        touchStartY = event.changedTouches[0].screenY;
    });

    carouselMovil.addEventListener('touchend', (event) => {
        touchEndX = event.changedTouches[0].screenX;
        touchEndY = event.changedTouches[0].screenY;
        handleSwipeGesture();
    });

    function handleSwipeGesture() {
        let diffX = Math.abs(touchEndX - touchStartX);
        let diffY = Math.abs(touchEndY - touchStartY);

        // Solo se registra el gesto si es más horizontal que vertical
        if (diffX > diffY) {
            if (touchEndX < touchStartX) {
                // Swipe izquierda
                if (index + 1 < pages.length) {
                    index++;
                    showPage(index);
                    updatePaginationDotsMovil();
                }
            }
            if (touchEndX > touchStartX) {
                // Swipe derecha
                if (index - 1 >= 0) {
                    index--;
                    showPage(index);
                    updatePaginationDotsMovil();
                }
            }
        }
    }

    // document.getElementById('prev-carusel-movil').addEventListener('click', () => {
    //     index = Math.max(0, index - 1);
    //     showPage(index);
    //     updatePaginationDotsMovil();
    // });

    // document.getElementById('next-carusel-movil').addEventListener('click', () => {
    //     index = Math.min(pages.length - 1, index + 1);
    //     showPage(index);
    //     updatePaginationDotsMovil();
    // });



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

    function openModalDesktop(id) {
        const premio = @json($premios).find(p => p.id === id);
        document.getElementById('premioModalLabelDesktop').textContent = premio.nombre;
        document.getElementById('premioModalImgDesktop').src = '{{ asset('assets/premios/') }}/' + premio.foto;
        document.getElementById('premioModalDescDesktop').textContent = premio.descripcion;
        document.getElementById('premioModalPuntosDesktop').textContent = `Puntos requeridos: ${premio.puntos}`;

        const premioModalBtnDesktop = document.getElementById('premioModalBtnDesktop');
        if ({{ $puntosUser }} < premio.puntos) {
            premioModalBtnDesktop.textContent = 'No disponible';
            premioModalBtnDesktop.disabled = true;
        } else {
            premioModalBtnDesktop.textContent = 'Redimir';
            premioModalBtnDesktop.disabled = false;
            premioModalBtnDesktop.setAttribute('wire:click', `redimir(${premio.id})`);
        }

        $('#premioModalDesktop').modal('show');
    }


    function showPageDesktop(indexDesktop) {
        pagesDesktop.forEach((page, i) => {
            page.style.display = i === indexDesktop ? 'flex' : 'none';
        });
    }

    showPageDesktop(indexDesktop);

    document.getElementById('prev-carousel-desktop').addEventListener('click', () => {
        indexDesktop = Math.max(0, indexDesktop - 1);
        showPageDesktop(indexDesktop);
        updatePaginationDots();
    });

    document.getElementById('next-carousel-desktop').addEventListener('click', () => {
        indexDesktop = Math.min(pagesDesktop.length - 1, indexDesktop + 1);
        showPageDesktop(indexDesktop);
        updatePaginationDots();
    });



    function showDescription(id) {
        document.getElementById('description-' + id).style.display = 'block';
    }

    function hideDescription(id) {
        document.getElementById('description-' + id).style.display = 'none';
    }

    // Genera los puntos de paginación movil
    pages.forEach((page, i) => {
        const dot = document.createElement('div');
        dot.classList.add('pagination-dot-movil');
        if (i === index) {
            dot.classList.add('active');
        }
        dot.addEventListener('click', () => {
            index = i;
            showPage(index);
            updatePaginationDotsMovil();
        });
        paginationDotsContainerMovil.appendChild(dot);
    });

    // Función para actualizar los puntos de paginación Movil
    function updatePaginationDotsMovil() {
        const dots = Array.from(paginationDotsContainerMovil.children);
        dots.forEach((dot, i) => {
            dot.classList.remove('active');
            if (i === index) {
                dot.classList.add('active');
            }
        });
    }

    // Genera los puntos de paginación desktop
    pagesDesktop.forEach((page, i) => {
        const dot = document.createElement('div');
        dot.classList.add('pagination-dot');
        if (i === indexDesktop) {
            dot.classList.add('active');
        }
        dot.addEventListener('click', () => {
            indexDesktop = i;
            showPageDesktop(indexDesktop);
            updatePaginationDots();
        });
        paginationDotsContainer.appendChild(dot);
    });

    // Función para actualizar los puntos de paginación desktop
    function updatePaginationDots() {
        const dots = Array.from(paginationDotsContainer.children);
        dots.forEach((dot, i) => {
            dot.classList.remove('active');
            if (i === indexDesktop) {
                dot.classList.add('active');
            }
        });
    }
</script>
