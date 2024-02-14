<div class="codigo-cont">
    <div class="codigo-text">
        <label for="">Codigo: </label>
        <input type="text" wire:model="codigo">
        @error('codigo')
            <div class="text-invalid-codigo">
                {{ $message }}
            </div>
        @enderror
        @error('codigo-bloqueado')
            <div class="text-invalid-codigo">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="codigo-btn-cont">
        <button wire:click="storePuntos" @error('codigo-bloqueado') disabled @enderror wire:loading.attr="disabled"
            wire:target="storePuntos">Canjear</button>
    </div>
    @if (session('success-registro-codigo'))
        <b>{{ session('success-registro-codigo') }}</b>
    @endif


</div>
