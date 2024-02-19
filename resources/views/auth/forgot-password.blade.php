<div class="login-div-cont">
    <h1 class="login-title-text">Recuperar contraseña</h1>
    <form action="{{ route('password.email') }}" class="login-form" method="POST">
        @csrf
        <div class="input-login-form">
            <label for="email">Correo: </label>
            <input id="email" type="email" name="email" value="{{old('email')}}" required>
        </div>
        @if (session('status'))
            {{ session('status') }}
        @endif 
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="text-invalid-login">
                    {{ $error }}
                </div>
            @endforeach
        @endif 
        <button type="submit">Enviar</button>
    </form>
</div> 
 
 