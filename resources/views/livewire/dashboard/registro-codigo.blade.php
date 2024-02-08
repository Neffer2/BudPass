<div>
    <div>
        <label for="">CODIGO</label>
        <input type="text" wire:model="codigo">
        @error('codigo')
            <div class="text-invalid">
                {{ $message }}
            </div>
        @enderror
    </div> 
    <div>
        <button wire:click="storePuntos" wire:loading.attr="disabled" wire:target="storePuntos">Canjear</button>
    </div>
    @if (session('success'))
        <b>{{ session('success') }}</b>
    @endif
</div>
