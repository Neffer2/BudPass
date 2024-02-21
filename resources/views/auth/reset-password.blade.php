<link rel="stylesheet" href="{{ asset('css/recuperar.css') }}">

<div class="recuperar-main-cont">
    <div class="recuperar-cont">
        <h1 class="recuperar-title">Restablecer contraseña</h1>
        <form method="POST" action="{{ route('password.store') }}" class="recuperar-form">
            @csrf
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="recuperar-input-group">
                <label for="email" class="recuperar-label">Email: </label>
                <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username" class="recuperar-input" />
            </div>

            <div class="recuperar-input-group">
                <label for="password" class="recuperar-label">Contraseña</label>
                <input id="password" type="password" name="password" required autocomplete="new-password" class="recuperar-input" />
            </div>

            <div class="recuperar-input-group">
                <label for="password_confirmation" class="recuperar-label">Confirmar contraseña: </label>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" class="recuperar-input" />
            </div>

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="recuperar-error">
                        {{ $error }}
                    </div>
                @endforeach
            @endif
            <button type="submit" class="recuperar-button">Enviar</button>
        </form>
    </div>
</div>