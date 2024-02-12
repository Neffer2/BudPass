<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <title>@yield('title')</title>
</head>

<body>
    <header>
        <div class="header-content">
            <div class="header-img">
                <img src="{{ asset('assets/budweiser/logo-budweiser.svg') }}" alt="Logo Budweiser" class=""
                    srcset="">
            </div>
            <div class="ham-open-icon" onclick="toggleMenu()">☰</div>
            <div class="menu-desk">
                <div class="menu-desk-item">
                    <a class="" href="#">Ranking</a>
                </div>
                <div class="menu-desk-item">
                    <a class="" href="#">Marketplace</a>
                </div>
                <div class="menu-desk-item">
                    <a class="" href="#">Registro</a>
                </div>
            </div>
            <div class="menu-desk-item-puntos">
                <p>Nombre <span class="puntos-header">Pts: 10000</span></p>
            </div>
        </div>
        <div class="ham-menu-list">
            <div class="sec-puntos">
                <p> Nombre <span class="puntos-header"> Pts: 10000 </span></p>
            </div>
            <div class="ham-item">
                <a class="" href="#">Ranking</a>
            </div>
            <div class="ham-item">
                <a class="" href="#">Marketplace</a>
            </div>
            <div class="ham-item">
                <a class="" href="#">Registro</a>
            </div>
            <div class="ham-item">
                <a class="" href="#">Cerrar sesión</a>
            </div>
        </div>
    </header>

    <nav>
        @auth
            {{ Auth::user()->name }}
            {{ number_format(Auth::user()->puntos) }}
        @endauth
    </nav>
    <hr>
    @yield('content')

    <footer>
        <div class="footer-container">
            <div class="top-footer">
                <div class="img-footer-container">
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
            <div class="line">
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
                <div class="consumo-vive-container">
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

        document.getElementById('show-login-btn').addEventListener('click', function() {
            document.getElementById('login-component').style.display = 'block';
            document.getElementById('register-component').style.display = 'none';
            this.classList.remove('inactive');
            document.getElementById('show-register-btn').classList.add('inactive');
        });

        document.getElementById('show-register-btn').addEventListener('click', function() {
            document.getElementById('register-component').style.display = 'block';
            document.getElementById('login-component').style.display = 'none';
            this.classList.remove('inactive');
            document.getElementById('show-login-btn').classList.add('inactive');
        });

        // Validación de fecha de nacimiento mayor de 18 años
        window.onload = function() {
            let today = new Date();
            let pastYear = today.getFullYear() - 18;
            today.setFullYear(pastYear);
            document.getElementById("fecha_nacimiento").max = today.toISOString().split("T")[0];
        }

        document.getElementById('fecha_nacimiento').addEventListener('click', function() {
            let today = new Date();
            let pastYear = today.getFullYear() - 18;
            today.setFullYear(pastYear);
            this.max = today.toISOString().split("T")[0];
        });
    </script>
</body>

</html>
