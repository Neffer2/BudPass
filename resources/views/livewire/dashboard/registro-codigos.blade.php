<div class="registro-codigo-form">
    <div class="codigo-cont">
        <div class="codigo-text">
            <label for="">Codigos: </label>
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
            @error('limite-puntos')
                <div class="text-invalid-codigo">
                    {{ $message }}
                </div>
            @enderror
            <div class="texto-consumo-cont-codigos">
                <p>*Te invitamos a registrar la compra de productos de manera responsable. <span>Límite de puntos
                        diario: 450 puntos.</span></p>

            </div>
        </div>

    </div>

    <div class="codigo-btn-cont">
        <button wire:click="storePuntos" @error('codigo-bloqueado') disabled @enderror wire:loading.attr="disabled"
            wire:target="storePuntos">Canjear</button>
    </div>
</div>
