<div class="registro-codigo-form">
    <div class="codigo-cont">
        <div class="codigo-text">
            <label for="">Codigos: </label>
            <input type="text" wire:model="codigo">
            <select name="" id=""></select>
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
                <p>*Te invitamos a registrar tus puntos de manera responsable. <span>Límite de puntos
                        diario: 450 puntos.</span></p>

            </div>
        </div>

    </div>

    <div class="codigo-btn-cont">
        <button wire:click="storePuntos" @error('codigo-bloqueado') disabled @enderror wire:loading.attr="disabled"
            wire:target="storePuntos">Canjear</button>
    </div>
</div>

<script>
    const btnCodigo = document.querySelector('.codigo-btn-cont button');
    const inputCodigo = document.querySelector('.codigo-text input');

    btnCodigo.addEventListener('click', () => {
        const valorCodigo = inputCodigo.value;

        dataLayer.push({
            'event': 'GAEvent',
            'event_category': 'Content',
            'event_action': 'button',
            'event_label': valorCodigo,
            'interaction': 'true',
            'component_name': 'btn_canjear_codigos',
            'element_text': 'cerrar',
            'campaign_description': 'Budpass',
        });
    });
</script>
