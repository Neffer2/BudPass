<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login-registro.css') }}">
    <link rel="stylesheet" href="{{ asset('css/registro-facturas-codigos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ranking.css') }}">
    <link rel="stylesheet" href="{{ asset('css/puntaje.css') }}">
    <link rel="stylesheet" href="{{ asset('css/market.css') }}">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
    <title>@yield('title')</title>
</head>

<body>
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
        <div class="cookies-info-cont">
            <div class="cookies-info-text">
                <p>En este sitio web se utilizan cookies y otras tecnologías de rastreo que se guardan en tu
                    dispositivo, nos ayudan a mejorar la navegación del sitio web, analizar el uso del mismo y colaborar
                    con nuestros estudios de marketing. Al hacer clic en Aceptar estas aceptando el uso de éstas. Conoce
                    más en nuestro Aviso de Privacidad</p>
            </div>
            <div class="cookie-info-config">
                <div class="cookie-btns">
                    <button class="cookies-aceptar-btn">Aceptar cookies</button>
                    <button class="cookies-rechazar-btn">Rechazar cookies</button>
                </div>
                <div class="cookie-configurar">
                    <p>Configurar</p>
                </div>
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
                            <a class="" href="{{ route('dashboard') }}">Registro</a>
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
                    <a class="" href="{{ route('dashboard') }}">Registro</a>
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
                    <img src="{{ asset('assets/budweiser/logo-budweiser.svg') }}" alt="" srcset="">
                    <div class="footer-text">
                        <div class="terminos-text">
                            <div class="politicas-p">
                                <a href="https://www.bavaria.co/sites/g/files/seuoyk1666/files/2024-02/Aviso%20de%20Privacidad%20%28V.5%29.pdf"
                                    target="_blank" rel="noopener noreferrer">
                                    <p>Aviso de Privacidad</p>
                                </a>
                                <a href="https://www.sic.gov.co/" target="_blank" rel="noopener noreferrer">
                                    <p>Superintendencia de industria y comercio</p>
                                </a>
                                <a href="https://www.bavaria.co/abilegal/politica-deproteccion-de-datos-personales"
                                    target="_blank" rel="noopener noreferrer">
                                    <p>Politica de protección de datos <span>personales</span></p>
                                </a>
                            </div>
                            <div class="terminos-p">
                                <a href="https://www.bavaria.co/viveresponsable" target="_blank"
                                    rel="noopener noreferrer">
                                    <p>Vive responsable</p>
                                </a>
                                <a href="https://www.bavaria.co/t%C3%A9rminos-y-condiciones" target="_blank"
                                    rel="noopener noreferrer">
                                    <p>Términos y condiciones</p>
                                </a>
                                <a href="https://www.budweiser.co/terminos-generales" target="_blank"
                                    rel="noopener noreferrer">
                                    <p>Términos y condiciones de la campaña</p>
                                </a>
                            </div>
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
            document.querySelector('.age-confirmation-cont').style.display = 'none';
            localStorage.setItem('ageConfirmed', 'true'); // TODO: Cambiar la manera de validación
            // Guardar la confirmación en el local storage
            if (checkRecordar.checked) {
                localStorage.setItem('ageConfirmed', 'true');
            }
        });

        document.getElementById('age-no').addEventListener('click', function() {
            window.location.href = 'https://www.google.com'; // reemplace esto con la URL a la que desea redirigir
        });

        //Aceptar-rechazar cookies
        document.querySelector('.cookies-aceptar-btn').addEventListener('click', function() {
            document.querySelector('.cookies-info-cont').style.visibility = 'hidden';
        });

        document.querySelector('.cookies-rechazar-btn').addEventListener('click', function() {
            document.querySelector('.cookies-info-cont').style.visibility = 'hidden';
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
            });
        @endif

        //TODO: 1.) Terminar la lista de redenciones en marketplace y publicidad 
        // 2.) Revisar popups de cookies y funcionamiento de cookies y verificación de mayor de edad
        // 3.) Branding con assets de Budweiser
        // 4) Funcionalidad de Camara para subir facturas y selfies
    </script>
</body>

</html>
