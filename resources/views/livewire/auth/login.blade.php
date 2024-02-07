<div class="login-div-container">
    <form action="/login" method="POST">
        @csrf
        <div>
            <label for="email_login">Nombre: </label>
            <input id="email_login" type="email" name="email">
        </div>
        <div>
            <label for="password_login"></label>
            <input id="password_login" type="password" name="password">
        </div>
        <div>
            <button type="submit">Iniciar</button>
        </div>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="text-invalid">
                    {{ $error }}
                </div>                
            @endforeach
        @endif
    </form>
</div>
 