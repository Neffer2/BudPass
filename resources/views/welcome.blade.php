@extends('layouts.app')
@section('content')
    <div class="page-forms-cont">

        <div class="main-forms-cont">
            <div class="main-forms-logo">
                <div class="big-logo-cont">
                    <img src="{{ asset('assets/budweiser/logo-budweiser.svg') }}" alt="Logo Budweiser" class=""
                        srcset="">
                </div>
            </div>
            <div class="regs-form-cont">
                <div class="form-btn">
                    <button id="show-login-btn" class="regs-btn ">Iniciar sesión</button>
                    <button id="show-register-btn" class="regs-btn secundario-btn">Registro</button>
                </div>
                <div id="login-component">
                    <livewire:auth.login />
                </div>
                <div id="register-component" style="display: none;">
                    <livewire:auth.register />
                </div>
            </div>
        </div>
    </div>

    <script>
        // TODO: Hacer una sección en el layout para poner todos los scripts
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
            this.classList.remove('secundario-btn');
            document.getElementById('show-register-btn').classList.add('secundario-btn');
        });

        document.getElementById('show-register-btn').addEventListener('click', function() {
            document.getElementById('register-component').style.display = 'block';
            document.getElementById('login-component').style.display = 'none';
            this.classList.remove('secundario-btn');
            document.getElementById('show-login-btn').classList.add('secundario-btn');
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
@endsection
