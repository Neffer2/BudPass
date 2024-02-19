<div class="login-div-cont">
    <h1 class="login-title-text">Iniciar sesión</h1>
    <form action="/login" class="login-form" method="POST">
        @csrf
        <div class="input-login-form">
            <label for="email_login">Email: </label>
            <input id="email_login" type="email" name="email" required>
        </div>
        <div class="input-login-form">
            <label for="password_login">Contraseña: </label>
            <input id="password_login" type="password" name="password" required>
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
            <a href="{{ route('password.request') }}">Recuperar Contraseña</a>
        </div>
    </form>
</div> 
