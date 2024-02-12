<div>
    <div>
        <label for="">CODIGO</label>
        <input type="text" wire:model="codigo">
    </div> 
    <div>
        <button wire:click="storePuntos" @error('codigo-bloqueado') disabled @enderror wire:loading.attr="disabled" wire:target="storePuntos">Canjear</button>
    </div>
    @error('codigo')
        <div class="text-invalid_">
            {{ $message }}
        </div>
    @enderror
    @error('codigo-bloqueado')
        <div class="text-invalid_">
            {{ $message }}
        </div> 
    @enderror
    @if (session('success-registro-codigo'))
        <b>{{ session('success-registro-codigo') }}</b>
    @endif
</div>
