<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <title>@yield('title')</title>
</head>

<body>
    {{-- <header>
        <div class="header-content">
            <div class="header-img">
                <img src="{{ asset('assets/budweiser/bud-logo.png') }}" alt="Logo Budweiser" class="" srcset="">
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
                <p>Juan Sebastian Camargo Prieto <span class="puntos-header">Puntaje: 10000</span></p>
            </div>
        </div>
        <div class="ham-menu-list">
            <div class="ham-item">
                <a class="" href="#">Ranking</a>
            </div>
            <div class="ham-item">
                <a class="" href="#">Marketplace</a>
            </div>
            <div class="ham-item">
                <a class="" href="#">Registro</a>
            </div>
            <div class="sec-puntos">
                <p>Juan Sebastian Camargo Prieto <span class="puntos-header"> Puntaje: 10000 </span></p>
            </div>
        </div>
    </header> --}}
    
    <nav>
        @auth
            {{ Auth::user()->name }}
            {{ Auth::user()->puntos }}
        @endauth
    </nav>
    <hr>
    @yield('content')

    <footer>
        <div class="footer-container">
            <div class="top-footer">
                <div class="img-footer-container">
                    <img src="{{ asset('assets/budweiser/bud-logo.png') }}" alt="" srcset="">
                    <div class="footer-text">
                        <div class="blue-text">
                            <p>Aviso de Privacidad</p>
                            <p>Politica de protección de datos <span>personales</span></p>

                        </div>
                        <div class="terminos-text">
                            <p>Términos y condiciones</p>
                            <p>Términos y condiciones de la campaña</p>
                        </div>

                    </div>
                </div>

                <div class="hablemos-container">
                    <img src="{{ asset('assets/budweiser/hablemos-de-alcohol.png') }}" class="footer-hablemos-img" alt="" srcset="">
                </div>
            </div>
            <div class="line"></div>
            <div class="disclaimer-container">
                <img src="{{ asset('assets/budweiser/disclaimer-bud.png') }}" class="footer-disclaimer-img" alt="Disclaimer" srcset="">
            </div>
            <div class="footer-info-text">
                <p>
                    © TXT, Inc. 2024.
                </p>
            </div>
        </div>
    </footer>

    <script>
        const toggleMenu = () => {
            let menu = document.querySelector('.ham-menu-list');
            let symbol = document.querySelector('.ham-open-icon');
            let imgHam = document.querySelector('.header-img');
            if (menu.style.display === 'none' || menu.style.display === '') {
                menu.style.display = 'block';
                symbol.innerHTML = 'X';
                imgHam.style.position = 'relative';
            } else {
                menu.style.display = 'none';
                symbol.innerHTML = '☰';
                imgHam.style.position = 'absolute';
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

    </script>
</body>
</html>
