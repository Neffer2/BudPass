<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-WKTBXXNH');
    </script>
    <!-- End Google Tag Manager -->

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login-registro.css') }}">
    <link rel="stylesheet" href="{{ asset('css/registro-facturas-codigos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ranking.css') }}">
    <link rel="stylesheet" href="{{ asset('css/puntaje.css') }}">
    <link rel="stylesheet" href="{{ asset('css/market.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.5.1/css/all.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
    <link rel="shortcut icon" href="https://www.budweiser.co/sites/g/files/seuoyk1191/files/favicon.ico"
        type="image/x-icon">
    <title>@yield('title', 'BudPass')</title>
</head>

<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WKTBXXNH" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <div class="age-confirmation-cont">
        <div class="age-confirmation-info">
            <div class="age-bud-logo">
                <img src="{{ asset('assets/budweiser/logo-budweiser-blanco.svg') }}" alt="Logo Blanco Bud"
                    srcset="">
            </div>
            <div class="age-bud-text">
                <p>¿Eres mayor de edad? <span>Para entrar acá debes ser mayor de edad</span></p>
            </div>

            <div class="age-bud-btn">
                <button id="age-yes">Sí</button>
                <button id="age-no">No</button>
            </div>
            <div class="check-recordar">
                <input type="checkbox" id="check_datos_recordados">
                <label for="check_datos_recordados">Recordar mis datos</label>
            </div>
            <div class="age-text-nosel">
                <p>*No selecciones esta opción si compartes este computador con menores de edad</p>
            </div>
        </div>
    </div>
    @auth
        <header class="bud-main-header">
            <div class="bud-header-content">
                <div class="header-img">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('assets/budweiser/logo-budweiser.svg') }}" alt="Logo Budweiser" class=""
                            srcset="">
                    </a>
                </div>
                <div class="ham-open-icon" onclick="toggleMenu()">☰</div>
                <div class="menu-desk-info">
                    <div class="menu-desk">
                        <div class="menu-desk-item {{ Route::currentRouteName() == 'ranking' ? 'active' : '' }}">
                            <a class="" href="{{ route('ranking') }}">Ranking</a>
                        </div>
                        <div class="menu-desk-item {{ Route::currentRouteName() == 'market' ? 'active' : '' }}">
                            <a class="" href="{{ route('market') }}">Marketplace</a>
                        </div>
                        <div class="menu-desk-item {{ Route::currentRouteName() == 'dashboard' ? 'active' : '' }}">
                            <a class="" href="{{ route('dashboard') }}">Registrar compra</a>
                        </div>
                    </div>
                    <div class="menu-desk-item-puntos" id="menu-toggle">
                        <p>{{ Auth::user()->name }} <span class="puntos-header">Pts:
                                {{ number_format(Auth::user()->puntos) }}</span></p>
                        <div id="dropdown-menu" style="display: none;">
                            <p><a href="#"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar
                                    sesión</a></p>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            <div class="ham-menu-list">
                <div class="sec-puntos">
                    <p> {{ Auth::user()->name }} <span class="puntos-header"> Pts:
                            {{ number_format(Auth::user()->puntos) }}
                        </span></p>
                </div>
                <div class="ham-item {{ Route::currentRouteName() == 'ranking' ? 'active' : '' }}">
                    <a class="" href="{{ route('ranking') }}">Ranking</a>
                </div>
                <div class="ham-item {{ Route::currentRouteName() == 'market' ? 'active' : '' }}">
                    <a class="" href="{{ route('market') }}">Marketplace</a>
                </div>
                <div class="ham-item {{ Route::currentRouteName() == 'dashboard' ? 'active' : '' }}">
                    <a class="" href="{{ route('dashboard') }}">Registrar compra</a>
                </div>
                <div class="ham-item">
                    <a href="#"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar sesión</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </header>
    @endauth
    @yield('content')

    <footer>
        <div class="footer-cont">
            <div class="top-footer">
                <div class="img-footer-cont">
                    <div class="img-bud-footer">
                        <img src="{{ asset('assets/budweiser/logo-budweiser.svg') }}" alt="" srcset="">
                    </div>

                    <div class="footer-socials">
                        <a href="https://www.facebook.com/CervezaBudweiserColombia" target="_blank"
                            aria-label="Facebook link"><i class="fab fa-facebook-f" alt="Logo Facebook"></i></a>
                        <a href="https://twitter.com/BudweiserCo" target="_blank" aria-label="Twitter link"><i
                                class="fa-brands fa-x-twitter" alt="Logo Twitter"></i></a>
                        <a href="https://www.instagram.com/budcolombia" target="_blank"
                            aria-label="Instagram link"><i class="fab fa-instagram" alt="Logo Instagram"></i></a>
                        <a href="https://www.youtube.com/BudweiserColombia" target="_blank"
                            aria-label="YouTube link"><i class="fab fa-youtube" alt="Logo YouTube"></i></a>
                        <a href="https://co.pinterest.com/Budweiser/" target="_blank" aria-label="Pinterest link"><i
                                class="fab fa-pinterest" alt="Logo Pinterest"></i></a>
                        <a href="https://www.tiktok.com/@budcolombia" target="_blank" aria-label="TikTok link"><i
                                class="fab fa-tiktok" alt="Logo TikTok"></i></a>
                    </div>
                </div>
                <div class="footer-text">
                    <div class="terminos-text">
                        <div class="terminos-right">
                            <a href="https://www.bavaria.co/sites/g/files/seuoyk1666/files/2024-02/Aviso%20de%20Privacidad%20%28V.5%29.pdf"
                                target="_blank" rel="noopener noreferrer">
                                <p>Aviso de Privacidad</p>
                            </a>
                            <a href="https://www.bavaria.co/viveresponsable" target="_blank"
                                rel="noopener noreferrer">
                                <p>Vive responsable</p>
                            </a>
                        </div>
                        <div class="terminos-center">
                            <a href="https://www.bavaria.co/t%C3%A9rminos-y-condiciones" target="_blank"
                                rel="noopener noreferrer">
                                <p>Términos y condiciones</p>
                            </a>
                            <a href="{{ asset('assets/legal/tyc-budpass.pdf') }}" target="_blank"
                                rel="noopener noreferrer">
                                <p>Términos y condiciones de la campaña</p>
                            </a>
                        </div>
                        <div class="terminos-left">
                            <a href="https://www.sic.gov.co/" target="_blank" rel="noopener noreferrer">
                                <p>Superintendencia de industria y comercio</p>
                            </a>
                            <a href="https://www.bavaria.co/abilegal/politica-deproteccion-de-datos-personales"
                                target="_blank" rel="noopener noreferrer">
                                <p>Politica de protección de datos <span>personales</span></p>
                            </a>
                        </div>
                    </div>

                </div>

            </div>
            <div class="bud-line-compartas">
                <p>No compartas este contenido con <span>menores de edad</span></p>
            </div>
            <div class="footer-bottom">
                <div class="exeso-footer">
                    <img src="{{ asset('assets/budweiser/exceso-footer.svg') }}" alt="Exeso" srcset="">
                </div>
                <div class="exeso-desk">
                    <img src="{{ asset('assets/budweiser/logo-bavaria.svg') }}" alt="Logo Bavaria">
                    <img src="{{ asset('assets/budweiser/exceso-text.svg') }}" alt="Exeso" srcset="">
                </div>
                <div class="consumo-vive-cont">
                    <div class="consumo">
                        <img src="{{ asset('assets/budweiser/consumo-responsable.svg') }}" alt="Consumo">
                    </div>
                    <div class="vive">
                        <a href="https://www.bavaria.co/viveresponsable" target="_blank"
                            rel="noopener noreferrer"><img src="{{ asset('assets/budweiser/vive-responsable.svg') }}"
                                alt="Vive"></a>
                    </div>
                </div>
                <div class="footer-info-text">
                    <p>
                        Anheuser-Busch InBev © Todos los derechos Reservados {{ date('Y') }}
                    </p>
                </div>
            </div>

        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <script>
        @if (request()->is('/'))
            function mostrarPopupBienvenida() {
                Swal.fire({
                    title: '¡Bienvenido!',
                    text: 'Ahora podrás acumular puntos con tus compras de Budweiser y redimirlos por entradas para experiencias, festivales, conciertos, producto o accesorios de la cerveza que enciende la noche y la fiesta en el mundo.',
                    confirmButtonText: 'Continuar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        dataLayer.push({
                            'event': 'GAEvent',
                            'event_category': 'Content',
                            'event_action': 'button',
                            'event_label': 'Pop_up_bienvenida',
                            'interaction': 'true',
                            'component_name': 'btn_popup_bienvenida',
                            'element_text': 'btn_continuar_bienvenida',
                            'campaign_description': 'Budpass'
                        });
                    }
                });

                sessionStorage.setItem('popupShowed', 'true');
            }

            // Función para verificar el estado del age-confirmation
            function verificarAgeConfirmation() {
                // Obtén el estado del age-confirmation del localStorage
                let ageConfirmed = localStorage.getItem('ageConfirmed');
                let popupMostrado = sessionStorage.getItem('popupShowed');


                // Si ageConfirmed es 'true', muestra el pop-up de bienvenida
                if (ageConfirmed === 'true' && popupMostrado !== 'true') {
                    mostrarPopupBienvenida();
                }
            }

            // Llama a la función verificarAgeConfirmation cuando la página se carga
            verificarAgeConfirmation();
        @endif

        //Modal boostrap para factura
        document.addEventListener('DOMContentLoaded', function() {
            // Para #myImg y #myImgDesk
            ['myImg', 'myImgDesk'].forEach(function(id) {
                let imgElement = document.getElementById(id);
                if (imgElement) { // Verificar si el elemento existe
                    imgElement.addEventListener('click', function() {
                        let modalId = id === 'myImg' ? 'myModal' : 'myModalDesk';
                        let imgId = id === 'myImg' ? 'img01' : 'img01Desk';
                        document.getElementById(imgId).src = imgElement.src;
                        let modal = new bootstrap.Modal(document.getElementById(modalId));
                        modal.show();
                    });
                }
            });
        });
        //Prueba confirmación de edad
        document.addEventListener('DOMContentLoaded', (event) => {
            if (localStorage.getItem('ageConfirmed') !== 'true') {
                document.querySelector('.age-confirmation-cont').style.display = 'flex';
            } else {
                document.querySelector('.age-confirmation-cont').style.display = 'none';
            }
        });

        //Prueba confirmación de edad
        const ageYesButton = document.getElementById('age-yes');
        const checkRecordar = document.getElementById('check_datos_recordados');
        ageYesButton.addEventListener('click', function() {
            dataLayer.push({
                'event': 'GAEvent',
                'event_category': 'Age Gate',
                'event_action': 'Interaction',
                'event_label': 'Yes',
                'interaction': 'False',
                'component_name': 'Yes',
                'element_text': 'Yes',
            });

            document.querySelector('.age-confirmation-cont').style.display = 'none';
            localStorage.setItem('ageConfirmed', 'true');
            mostrarPopupBienvenida();
            if (checkRecordar.checked) {
                localStorage.setItem('ageConfirmed', 'true');
                mostrarPopupBienvenida();
            }
        });

        document.getElementById('age-no').addEventListener('click', function() {
            dataLayer.push({
                'event': 'GAEvent',
                'event_category': 'Age Gate',
                'event_action': 'Interaction',
                'event_label': 'No',
                'interaction': 'False',
                'component_name': 'No',
                'element_text': 'No',
            });
            window.location.href = 'https://www.tapintoyourbeer.com/';
        });

        //Menu hamburguesa
        const toggleMenu = () => {
            let menu = document.querySelector('.ham-menu-list');
            let symbol = document.querySelector('.ham-open-icon');
            if (menu.style.display === 'none' || menu.style.display === '') {
                menu.style.display = 'block';
                symbol.innerHTML = 'X';
            } else {
                menu.style.display = 'none';
                symbol.innerHTML = '☰';
            }
        }

        // Dropdown menu desktop 
        const menuToggle = document.getElementById('menu-toggle');
        if (menuToggle) {
            menuToggle.addEventListener('click', function() {
                let dropdownMenu = document.getElementById('dropdown-menu');
                if (dropdownMenu.style.display === 'none') {
                    dropdownMenu.style.display = 'flex';
                } else {
                    dropdownMenu.style.display = 'none';
                }
            });
        }

        // Mostrar y ocultar contraseña
        const togglePasswordVisibility = (id) => {
            const passwordInput = document.getElementById(id);
            let eyeIcon = document.querySelector(`i[onclick="togglePasswordVisibility('${id}')"]`);
            let type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            if (type === 'text') {
                eyeIcon.classList.remove("fa-eye-slash");
                eyeIcon.classList.add("fa-eye");
            } else {
                eyeIcon.classList.remove("fa-eye");
                eyeIcon.classList.add("fa-eye-slash");
            }
        }

        // Registro y login
        const showLoginBtn = document.getElementById('show-login-btn');
        if (showLoginBtn) {
            showLoginBtn.addEventListener('click', function() {
                document.getElementById('login-component').style.display = 'block';
                document.getElementById('register-component').style.display = 'none';
                this.classList.remove('secundario-btn');
                document.getElementById('show-register-btn').classList.add('secundario-btn');
            });
        }

        const showRegisterBtn = document.getElementById('show-register-btn');
        if (showRegisterBtn) {
            showRegisterBtn.addEventListener('click', function() {
                document.getElementById('register-component').style.display = 'block';
                document.getElementById('login-component').style.display = 'none';
                this.classList.remove('secundario-btn');
                document.getElementById('show-login-btn').classList.add('secundario-btn');
            });
        }

        // Registro de códigos y facturas
        const showFacturasBtn = document.getElementById('show-facturas-btn');
        const showCodigoBtn = document.getElementById('show-codigo-btn');
        const registroFacturaForm = document.querySelector('.registro-factura-form');
        const registroCodigoForm = document.querySelector('.registro-codigo-form');

        if (showFacturasBtn && showCodigoBtn && registroFacturaForm && registroCodigoForm) {
            showFacturasBtn.addEventListener('click', function() {
                registroFacturaForm.style.display = 'flex';
                registroCodigoForm.style.display = 'none';
                this.classList.remove('secundario-btn');
                showCodigoBtn.classList.add('secundario-btn');
            });

            showCodigoBtn.addEventListener('click', function() {
                registroFacturaForm.style.display = 'none';
                registroCodigoForm.style.display = 'flex';
                this.classList.remove('secundario-btn');
                showFacturasBtn.classList.add('secundario-btn');
            });
        }

        const premiosBtn = document.getElementById('show-premios-btn');
        const redencionesBtn = document.getElementById('show-redenciones-btn');
        const premiosCont = document.querySelector('.premios-cont');
        const redencionesCont = document.querySelector('.redenciones-premios-cont');

        if (premiosBtn && redencionesBtn && premiosCont && redencionesCont) {
            premiosBtn.addEventListener('click', function() {
                premiosCont.style.display = 'flex';
                redencionesCont.style.display = 'none';
                this.classList.remove('secundario-btn');
                redencionesBtn.classList.add('secundario-btn');
            });

            redencionesBtn.addEventListener('click', function() {
                premiosCont.style.display = 'none';
                redencionesCont.style.display = 'flex';
                this.classList.remove('secundario-btn');
                premiosBtn.classList.add('secundario-btn');
            });
        }

        // Validación de fecha de nacimiento mayor de 18 años
        window.onload = function() {
            let fechaNacimiento = document.getElementById('fecha_nacimiento');
            if (fechaNacimiento) {
                let today = new Date();
                let pastYear = today.getFullYear() - 18;
                today.setFullYear(pastYear);
                fechaNacimiento.max = today.toISOString().split("T")[0];
            }
        }

        let fechaNacimiento = document.getElementById('fecha_nacimiento');
        if (fechaNacimiento) {
            fechaNacimiento.addEventListener('click', function() {
                let today = new Date();
                let pastYear = today.getFullYear() - 18;
                today.setFullYear(pastYear);
                this.max = today.toISOString().split("T")[0];
            });
        }

        // Sweetalert

        @if (session('success-registro-codigo'))
            Swal.fire({
                title: "¡Código redimido!",
                text: "{{ session('success-registro-codigo') }}",
                confirmButtonText: 'ACEPTAR'
            });
        @endif

        @if (session('success'))
            Swal.fire({
                title: "{{ session('title') }}",
                text: "{{ session('success') }}",
                confirmButtonText: 'ACEPTAR'
            }).then((result) => {
                if (result.isConfirmed) {
                    dataLayer.push({
                        'event': 'GAEvent',
                        'event_category': 'Content',
                        'event_action': 'button',
                        'event_label': 'Pop_up_validacion_facturas',
                        'interaction': 'true',
                        'component_name': 'btn_validar_factura',
                        'element_text': 'buttonName', // nombre del botón
                        'campaign_description': 'Budpass',
                    });
                }
            });
        @endif

        @if (session('session-success'))
            dataLayer.push({
                'event': 'GAEvent',
                'event_category': 'Login',
                'event_action': 'Sucess',
                'event_label': 'Login_success',
                'userUid': "{{ Auth::user()->name }}" // user id (string)
            });
        @endif

        @if (session('success-redencion'))
            Swal.fire({
                title: "{{ session('title') }}",
                text: "{{ session('success-redencion') }}",
                confirmButtonText: 'ACEPTAR'
            }).then((result) => {
                if (result.isConfirmed) {
                    dataLayer.push({
                        'event': 'GAEvent',
                        'event_category': 'Content',
                        'event_action': 'button',
                        'event_label': 'cerrar_redencion_proceso',
                        'interaction': 'true',
                        'component_name': 'btn_cerrar_proceso',
                        'element_text': 'cerrar',
                        'campaign_description': 'Budpass',
                    });
                }
            });
        @endif

        // @if (session('register-success'))
        //     Swal.fire({
        //         title: "{{ session('title') }}",
        //         text: "{{ session('register-success') }}",
        //         confirmButtonText: 'ACEPTAR'
        //     });
        // @endif

        //TODO: 1) Funcionalidad de Camara para subir facturas y selfies
        // 2) Revisar funcionamiento de cookies
        // 3) Agregar redes sociales
        // 4) Eliminar console.logs de dataLayers
    </script>
</body>

</html>
