<div class="market-main-cont">

    <div class="market-destacados">
        @include('puntaje')

        <div id="publicidad-cont">
            <img id="carousel-image-publicidad-current" src="{{ asset('assets/budweiser/destacado-jueves.jpg') }}">
            <img id="carousel-image-publicidad-next" class="hidden">
        </div>
    </div>

    <div class="main-premios-redenciones-cont">

        <div class="market-btn-cont">
            <button id="show-premios-btn" class="market-btn">Market</button>
            <button id="show-redenciones-btn" class="market-btn secundario-btn">Redenciones</button>
        </div>

        <div class="premios-cont">
            <div class="carousel-movil">

                @php
                    foreach ($destacados as $destacado) {
                        $destacado->type = 'destacado';
                    }
                    foreach ($premios as $premio) {
                        $premio->type = 'premio';
                    }
                    $interleavedItems = collect([]);
                    foreach ($destacados as $index => $destacado) {
                        $interleavedItems->push($destacado);
                        if (isset($premios[$index])) {
                            $interleavedItems->push($premios[$index]);
                        }
                    }
                    $remainingPremios = $premios->slice($destacados->count());
                    $items = $interleavedItems->concat($remainingPremios)->filter();
                @endphp

                @foreach ($items->chunk(2) as $chunk)
                    <div class="carousel-page-movil">
                        @foreach ($chunk as $item)
                            <div class="premios-img-cont-movil" data-id="{{ $item->id }}"
                                x-on:click="{{ $item->type === 'destacado' ? 'openModalDestacadoMovil' : 'openModal' }}({{ $item->id }})">
                                <img class="{{ $item->type === 'destacado' ? 'img-destacado-movil' : '' }}"
                                    src='{{ asset("assets/premios/$item->foto") }}' height="200" alt="">
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
                                    <button type="button" wire:loading.class="redencion-loading" wire:click="redimir"
                                        wire:target="redimir" class="btn-modal-premios-redimir"
                                        id="premioModalBtn"><span id="redimirText" wire:loading.remove
                                            wire:target="redimir">Redimir</span>
                                        <span id="cargandoText" style="display: none;" wire:loading
                                            wire:target="redimir">Cargando...</span>
                                        <span id="noDisponibleText" style="display: none;">No
                                            disponible</span></button>
                                    <button type="button" class="btn-modal-premios-close" id="premio_cerrar_movil"
                                        data-dismiss="modal">Cerrar</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade custom-modal" id="destacadoModalMovil" tabindex="-1"
                    aria-labelledby="destacadoModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body custom-modal-body">
                                <h2 class="modal-title custom-modal-title" id="destacadoModalLabelMovil"></h2>
                                <button type="button" class="close custom-close" data-dismiss="modal"
                                    aria-label="Close">
                                    <img src="{{ asset('assets/budweiser/icono-cerrar-popup.svg') }}"
                                        aria-hidden="true">
                                </button>
                                <div class="modal-img-custom">
                                    <img id="destacadoModalImgMovil" src="" alt=""
                                        class="custom-modal-img">
                                </div>
                                <p id="destacadoModalDescMovil" class="custom-modal-desc"></p>
                                <button type="button" class="btn-modal-premios-close" id="destacado_cerrar"
                                    data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pagination-dots-movil"></div>

            </div>

            <div class="carousel-desktop">

                <div class="carousel-destacados-desk">
                    @if ($destacados)
                        <div class="destacados-cont-desk" x-on:click="openModalDestacado({{ $destacados[0]->id }})">
                            <img src='{{ asset('assets/premios/destacado-jueves-desk.jpg') }}' alt="">
                        </div>
                        <div class="destacados-cont-desk" x-on:click="openModalDestacado({{ $destacados[1]->id }})">
                            <img src='{{ asset('assets/premios/destacado-viernes-desk.jpg') }}' alt="">
                        </div>
                        <div class="destacados-cont-desk" x-on:click="openModalDestacado({{ $destacados[2]->id }})">
                            <img src='{{ asset('assets/premios/destacado-sabado-desk.jpg') }}' alt="">
                        </div>
                        <div class="destacados-cont-desk" x-on:click="openModalDestacado({{ $destacados[3]->id }})">
                            <img src='{{ asset('assets/premios/destacado-domingo-desk.jpg') }}' alt="">
                        </div>
                    @endif
                </div>

                <div class="modal fade custom-modal" id="destacadoModal" tabindex="-1"
                    aria-labelledby="destacadoModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body custom-modal-body">
                                <h2 class="modal-title custom-modal-title" id="destacadoModalLabel"></h2>
                                <button type="button" class="close custom-close" data-dismiss="modal"
                                    aria-label="Close">
                                    <img src="{{ asset('assets/budweiser/icono-cerrar-popup.svg') }}"
                                        aria-hidden="true">
                                </button>
                                <div class="modal-img-custom">
                                    <img id="destacadoModalImg" src="" alt=""
                                        class="custom-modal-img">
                                </div>
                                <p id="destacadoModalDesc" class="custom-modal-desc"></p>
                                <button type="button" class="btn-modal-premios-close" id="destacado_cerrar"
                                    data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>

                @foreach ($premios->chunk(4) as $chunk)
                    <div class="carousel-page-desktop">
                        @foreach ($chunk as $premio)
                            <div id="premios_img_cont" @class([
                                'premios-img-cont-desktop' => true,
                                'disabled-premio' => $puntosUser < $premio->puntos,
                            ]) data-id="{{ $premio->id }}"
                                x-on:click="openModalDesktop({{ $premio->id }})"
                                x-on:mouseover="showDescription({{ $premio->id }})"
                                x-on:mouseout="hideDescription({{ $premio->id }})">
                                <img class="img-premio" src='{{ asset("assets/premios/$premio->foto") }}'
                                    height="200" alt="">
                                <div class="product-description" id="description-{{ $premio->id }}">
                                    {{ $premio->nombre }}
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
                                    <button type="button" wire:loading.class="redencion-loading"
                                        wire:click="redimir" wire:target="redimir" class="btn-modal-premios-redimir"
                                        id="premioModalBtnDesktop"><span id="redimirTextDesk" wire:loading.remove
                                            wire:target="redimir">Redimir</span>
                                        <span id="cargandoTextDesk" style="display: none;" wire:loading
                                            wire:target="redimir">Cargando...</span>
                                        <span id="noDisponibleTextDesk" style="display: none;">No
                                            disponible</span></button>
                                    <button type="button" class="btn-modal-premios-close" id="premio_cerrar_desktop"
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
            <livewire:dashboard.market.redenciones :user_id="$user->id" :key="$user->id" />
        </div>
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
                if (index + 1 >= pages.length) {
                    index = 0;
                } else {
                    index++;
                }
                showPage(index);
                updatePaginationDotsMovil();
            }
            if (touchEndX > touchStartX) {
                // Swipe derecha
                if (index - 1 < 0) {
                    index = pages.length - 1;
                } else {
                    index--;
                }
                showPage(index);
                updatePaginationDotsMovil();
            }
        }
    }



    function openModal(id) {
        const premio = @json($premios).find(p => p.id === id);
        document.getElementById('premioModalLabel').textContent = premio.nombre;
        document.getElementById('premioModalImg').src = '{{ asset('assets/premios/') }}/' + premio.foto;
        document.getElementById('premioModalDesc').textContent = premio.descripcion;
        document.getElementById('premioModalPuntos').textContent = `Puntos requeridos: ${premio.puntos}`;

        const premioModalBtn = document.getElementById('premioModalBtn');
        const redimirText = document.getElementById('redimirText');
        const noDisponibleText = document.getElementById('noDisponibleText');
        if ({{ $puntosUser }} < premio.puntos) {
            premioModalBtn.setAttribute('wire:click', '');
            premioModalBtn.disabled = true;
            redimirText.style.display = 'none';
            noDisponibleText.style.display = 'inline';
        } else {
            premioModalBtn.setAttribute('wire:click', `redimir(${premio.id})`);
            premioModalBtn.disabled = false;
            redimirText.style.display = 'inline';
            noDisponibleText.style.display = 'none';
        }

        $('#premioModal').modal('show');
    }

    function openModalDesktop(id) {
        const premio = @json($premios).find(p => p.id === id);
        const premioModalBtnDesktop = document.getElementById('premioModalBtnDesktop');
        const redimirTextDesk = document.getElementById('redimirTextDesk');
        const noDisponibleTextDesk = document.getElementById('noDisponibleTextDesk');
        document.getElementById('premioModalLabelDesktop').textContent = premio.nombre;
        document.getElementById('premioModalImgDesktop').src = '{{ asset('assets/premios/') }}/' + premio.foto;
        document.getElementById('premioModalDescDesktop').textContent = premio.descripcion;
        document.getElementById('premioModalPuntosDesktop').textContent = `Puntos requeridos: ${premio.puntos}`;


        if ({{ $puntosUser }} < premio.puntos) {
            premioModalBtnDesktop.setAttribute('wire:click', '');
            premioModalBtnDesktop.disabled = true;
            redimirTextDesk.style.display = 'none';
            noDisponibleTextDesk.style.display = 'inline';
        } else {
            premioModalBtnDesktop.setAttribute('wire:click', `redimir(${premio.id})`);
            premioModalBtnDesktop.disabled = false;
            redimirTextDesk.style.display = 'inline';
            noDisponibleTextDesk.style.display = 'none';
        }

        $('#premioModalDesktop').modal('show');
    }


    function openModalDestacado(id) {
        const destacado = @json($destacados).find(d => d.id === id);
        document.getElementById('destacadoModalLabel').textContent = destacado.nombre;
        document.getElementById('destacadoModalImg').src = '{{ asset('assets/premios/') }}/' + destacado.foto;
        document.getElementById('destacadoModalDesc').textContent = destacado.descripcion;

        $('#destacadoModal').modal('show');
    }

    function openModalDestacadoMovil(id) {
        const destacadoMovil = @json($destacados).find(d => d.id === id);
        document.getElementById('destacadoModalLabelMovil').textContent = destacadoMovil.nombre;
        document.getElementById('destacadoModalImgMovil').src = '{{ asset('assets/premios/') }}/' + destacadoMovil
            .foto;
        document.getElementById('destacadoModalDescMovil').textContent = destacadoMovil.descripcion;

        $('#destacadoModalMovil').modal('show');
    }


    function showPageDesktop(indexDesktop) {
        pagesDesktop.forEach((page, i) => {
            page.style.display = i === indexDesktop ? 'flex' : 'none';
        });
    }

    showPageDesktop(indexDesktop);

    document.getElementById('prev-carousel-desktop').addEventListener('click', () => {
        if (indexDesktop - 1 < 0) {
            indexDesktop = pagesDesktop.length - 1;
        } else {
            indexDesktop--;
        }
        showPageDesktop(indexDesktop);
        updatePaginationDots();
    });

    document.getElementById('next-carousel-desktop').addEventListener('click', () => {
        if (indexDesktop + 1 >= pagesDesktop.length) {
            indexDesktop = 0;
        } else {
            indexDesktop++;
        }
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

    // Carrusel dinámico

    let carruselImg = [
        "{{ asset('assets/budweiser/destacado-jueves.jpg') }}",
        "{{ asset('assets/budweiser/destacado-viernes.jpg') }}",
        "{{ asset('assets/budweiser/destacado-sabado.jpg') }}",
        "{{ asset('assets/budweiser/destacado-domingo.jpg') }}"
    ];

    let currentCarruselIndex = -1;

    function changeCarruselImage() {
        currentCarruselIndex = (currentCarruselIndex + 1) % carruselImg.length;

        const imgElementCurrent = document.getElementById("carousel-image-publicidad-current");
        const imgElementNext = document.getElementById("carousel-image-publicidad-next");

        imgElementNext.src = carruselImg[currentCarruselIndex];
        imgElementNext.classList.remove("hidden");

        setTimeout(() => {
            imgElementCurrent.classList.add("fade-out");
            imgElementCurrent.src = imgElementNext.src;
            imgElementCurrent.classList.remove("fade-out");
            imgElementNext.classList.add("hidden");
        }, 3000);
    }

    changeCarruselImage();
    setInterval(changeCarruselImage, 7000);

    const tituloProductoDesk = document.getElementById('premioModalLabelDesktop');

    document.getElementById('premioModalBtnDesktop').addEventListener('click', function() {
        dataLayer.push({
            'event': 'GAEvent',
            'event_category': 'Content',
            'event_action': 'button',
            'event_label': 'redimir_producto',
            'interaction': 'true',
            'component_name': 'btn_redimir_producto',
            'element_text': tituloProductoDesk.innerHTML,
            'campaign_description': 'Budpass',
        });
    });


    document.getElementById('premio_cerrar_desktop').addEventListener('click', function() {
        dataLayer.push({
            'event': 'GAEvent',
            'event_category': 'Content',
            'event_action': 'button',
            'event_label': 'cancelar_producto',
            'interaction': 'true',
            'component_name': 'btn_cancelar_producto',
            'element_text': tituloProductoDesk.innerHTML,
            'campaign_description': 'Budpass',
        });
    });

    function enviarDesktop(descripcion) {
        this.descripcionPremio = descripcion;
        dataLayer.push({
            'event': 'GAEvent',
            'event_category': 'Content',
            'event_action': 'button',
            'event_label': 'confirmar_redencion',
            'interaction': 'true',
            'component_name': 'btn_confirmar_redencion_puntos',
            'element_text': this.descripcionPremio,
            'campaign_description': 'Budpass',
        });
    }

    // otras funciones...

    const tituloProductoMovil = document.getElementById('premioModalLabel');

    document.getElementById('premioModalBtn').addEventListener('click', function() {
        dataLayer.push({
            'event': 'GAEvent',
            'event_category': 'Content',
            'event_action': 'button',
            'event_label': 'redimir_producto',
            'interaction': 'true',
            'component_name': 'btn_redimir_producto',
            'element_text': tituloProductoMovil.innerHTML,
            'campaign_description': 'Budpass',
        });
    });

    document.getElementById('premio_cerrar_movil').addEventListener('click', function() {
        dataLayer.push({
            'event': 'GAEvent',
            'event_category': 'Content',
            'event_action': 'button',
            'event_label': 'cancelar_producto',
            'interaction': 'true',
            'component_name': 'btn_cancelar_producto',
            'element_text': tituloProductoMovil.innerHTML,
            'campaign_description': 'Budpass',
        });
    });

    document.querySelector('.premios-img-cont-movil').addEventListener('click', function() {
        dataLayer.push({
            'event': 'GAEvent',
            'event_category': 'Content',
            'event_action': 'button',
            'event_label': 'confirmar_redencion',
            'interaction': 'true',
            'component_name': 'btn_confirmar_redencion_puntos',
            'element_text': tituloProductoMovil
                .innerHTML, // variable dinámica que traiga el nombre del botón
            'campaign_description': 'Budpass',
        });
    });
</script>
