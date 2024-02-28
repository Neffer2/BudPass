<link rel="stylesheet" href="{{ asset('css/recuperar.css') }}?v={{ time() }}">

<div class="recuperar-main-cont">
    <div class="recuperar-cont">
        <h1 class="recuperar-title">Recuperar contraseña</h1>
        <form action="{{ route('password.email') }}" class="recuperar-form" method="POST">
            @csrf
            <div class="recuperar-input-group">
                <label for="email" class="recuperar-label">Correo: </label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required
                    class="recuperar-input">
            </div>
            @if (session('status'))
                <div class="recuperar-status">
                    {{ session('status') }}
                </div>
            @endif
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="recuperar-error">
                        {{ $error }}
                    </div>
                @endforeach
            @endif
            <div class="recuperar-cont-btn-cont">
                <a href="{{ url('/') }}" class="recuperar-button-volver">Volver</a>
                <button type="submit" class="recuperar-button">Enviar</button>
            </div>

        </form>
    </div>
</div>
