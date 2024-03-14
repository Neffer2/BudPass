<div class="registro-codigo-form">
    <div class="codigo-cont">
        <div class="codigo-text">
            <label for="inputCodigos">Codigos: </label>
            <input type="text" wire:model="codigo" class="mb-3" id="inputCodigos">
            
            <label for="punto_entrega">¿D&oacute;nde obtuviste tu c&oacute;digo?</label>
            <select id="punto_entrega" wire:model="punto_entrega" class="mt-0"> 
                <option value="">Selecciona una opción</option>
                <option value="Tienda de Barrio">Tienda de Barrio</option>
                <option value="LicoExpress">LicoExpress</option>
                <option value="Licorera">Licorera</option>
                <option value="Restaurante">Restaurante</option>
                <option value="TADA">TADA</option>
                <option value="RAPPI">RAPPI</option>
                <option value="Influencer">Influencer</option> 
                <option value="Otro">Otro</option>
            </select>

            @error('punto_entrega')
                <div class="error-punto-entrega">
                    {{ $message }}
                </div>
            @enderror
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
            <div class="texto-consumo-cont-codigos" style="display: none;">
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
