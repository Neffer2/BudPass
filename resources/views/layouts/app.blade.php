<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login-registro.css') }}">
    <link rel="stylesheet" href="{{ asset('css/registro-facturas-codigos.css') }}">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>@yield('title')</title>
</head>
<body>
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
                        <div class="menu-desk-item">
                            <a class="" href="{{ route('ranking') }}">Ranking</a>
                        </div>
                        <div class="menu-desk-item">
                            <a class="" href="{{ route('market') }}">Marketplace</a>
                        </div>
                        <div class="menu-desk-item">
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
                <div class="ham-item">
                    <a class="" href="{{ route('ranking') }}">Ranking</a>
                </div>
                <div class="ham-item">
                    <a class="" href="{{ route('market') }}">Marketplace</a>
                </div>
                <div class="ham-item">
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
                                <p>Aviso de Privacidad</p>
                                <p>Politica de protección de datos <span>personales</span></p>
                            </div>
                            <div class="terminos-p">
                                <p>Términos y condiciones</p>
                                <p>Términos y condiciones de la campaña</p>
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
                        <img src="{{ asset('assets/budweiser/vive-responsable.svg') }}" alt="Vive">
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

    <script>
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
        let menuToggle = document.getElementById('menu-toggle');
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
        let showLoginBtn = document.getElementById('show-login-btn');
        if (showLoginBtn) {
            showLoginBtn.addEventListener('click', function() {
                document.getElementById('login-component').style.display = 'block';
                document.getElementById('register-component').style.display = 'none';
                this.classList.remove('secundario-btn');
                document.getElementById('show-register-btn').classList.add('secundario-btn');
            });
        }

        let showRegisterBtn = document.getElementById('show-register-btn');
        if (showRegisterBtn) {
            showRegisterBtn.addEventListener('click', function() {
                document.getElementById('register-component').style.display = 'block';
                document.getElementById('login-component').style.display = 'none';
                this.classList.remove('secundario-btn');
                document.getElementById('show-login-btn').classList.add('secundario-btn');
            });
        }

        // Registro de códigos y facturas
        let showFacturasBtn = document.getElementById('show-facturas-btn');
        let showCodigoBtn = document.getElementById('show-codigo-btn');
        let registroFacturaForm = document.querySelector('.registro-factura-form');
        let registroCodigoForm = document.querySelector('.registro-codigo-form');

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
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>

</html>
