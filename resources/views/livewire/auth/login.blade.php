<div>
    <form action="/login" method="POST">
        @csrf
        <div>
            <label for="email">Nombre: </label>
            <input id="email" type="email" wire:model="emailLogin" name="email">
        </div>
        <div>
            <label for="password"></label>
            <input id="password" type="password" wire:model="passwordLive" name="password">
        </div>
        <div>
            <button type="submit">{{ _('Iniciar') }}</button>
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
 