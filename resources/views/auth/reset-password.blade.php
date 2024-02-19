<div>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">
        
        <div>
            <label for="">Email: </label>
            <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username" />
        </div>

        <div>
            <label for="">Contraseña</label>
            <input id="password" type="password" name="password" required autocomplete="new-password" />
        </div>

        <div>
            <label for="">Confirmar contraseña: </label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" />
        </div>
        
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