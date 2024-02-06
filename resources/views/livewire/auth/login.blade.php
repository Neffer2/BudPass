<div>
    <form action="/login" method="POST">
        @csrf
        <div>
            <label for="email">Nombre: </label>
            <input id="email" type="email" wire:model.change="emailLogin" name="email">
            @error('emailLogin')
                <div class="text-invalid">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div>
            <label for="password"></label>
            <input id="password" type="password" wire:model.change="passwordLive" name="password">
            @error('passwordLive')
                <div class="text-invalid">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div>
            <button type="submit">{{ _('Iniciar') }}</button>
        </div>
    </form>
    @if ($errors->any())
        <div class="text-invalid">
            {{ $errors->first('email') }}
        </div>    
    @endif
</div>
 