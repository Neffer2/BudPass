<div class="login-div-cont">
    <div class="login-title-text">Iniciar sesión</div>
    <form action="/login" class="login-form" method="POST">
        @csrf
        <div class="input-login-form">
            <label for="email_login">Email: </label>
            <input id="email_login" type="email" name="email">
        </div>
        <div class="input-login-form">
            <label for="password_login">Contraseña: </label>
            <input id="password_login" type="password" name="password">
        </div>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="text-invalid-login">
                    {{ $error }}
                </div>
            @endforeach
        @endif
        <div class="login-form-btn">
            <button type="submit">Iniciar</button>
        </div>
        <div>
            <a href="">Recuperar Contraseña</a>
        </div>

    </form>
</div>
