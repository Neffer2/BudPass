<div class="registro-facturas-cont">
    <div class="nit-cont">
        <div class="nit-label-cont">
            <label for="">NIT:</label>
            <input type="text" wire:model.live.debounce.500ms="nit">
        </div>
        <div class="nit-img-main-cont">
            <label for="">Referencia canal:</label>
            <div class="nit-img">
                <img @if ($canal) src="{{ asset("assets/canales/$canal->logo") }}" @endif
                    alt="">
            </div>
        </div>
        @error('nit')
            <div class="text-invalid-factura">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="desk-factura-cont">
        <div class="desk-left-cont">
            <div class="num-factura-cont">
                <label for="">Número de factura:</label>
                <input type="text" wire:model.change="num_factura">
                @error('num_factura')
                    <div class="text-invalid-factura">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="modal fade" id="myModal">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content" id="modal_facturas">
                        <!-- The Close Button -->
                        <div class="text-right">
                            <button type="button" class="close" data-dismiss="modal"
                                style="font-size: 50px; color: red; padding-right:5px">&times;</button>
                        </div>
                        <!-- Modal body -->
                        <div class="modal-body d-flex justify-content-center">
                            <img class="img-fluid" id="img01" style="max-width: 70%; height: auto;">
                        </div>
                    </div>
                </div>
            </div>

            <div class="factura-img-main-movil">
                <label for="">Referencia factura:</label>
                <div class="factura-img-cont">
                    <img id="myImg"
                        @if ($canal) src="{{ asset("assets/facturas/$canal->ejemplo_factura") }}" @endif
                        alt="">
                </div>

            </div>

            <div class="sel-producto-cont">
                <label for="">Producto:</label>
                <select wire:model.change="producto">
                    <option value="">Seleccionar</option>
                    @if ($canal)
                        @foreach ($this->canal->productos as $producto)
                            <option value="{{ $producto->id }}">{{ $producto->descripcion }}</option>
                        @endforeach
                    @endif
                </select>
                @error('producto')
                    <div class="text-invalid-factura">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="cantidad-agregar-cont">
                <div class="cantidad-productos-cont">
                    <label for="">Cantidad: </label>
                    <input type="number" wire:model.change='cantidad'>
                    @error('productos')
                        <div class="text-invalid-factura" id="text_invalid_cantidad">
                            {{ $message }}
                        </div>
                    @enderror
                    @error('cantidad')
                        <div class="text-invalid-factura" id="text_invalid_cantidad">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="agregar-producto-btn-cont">
                    <button x-on:click="$wire.addProduct()">Agregar productos</button>
                </div>

            </div>

            <div class="texto-consumo-cont">
                <p>*Te invitamos a registrar la compra de productos de manera responsable. <span>Límite de puntos
                        diario: 450 puntos.</span></p>

            </div>



            <div class="lista-productos-cont">
                <label for="">Listado de productos</label>
                <table>
                    <tr>
                        <td class="lista-productos-subtitle">Producto</td>
                        <td class="lista-productos-subtitle">Cantidad</td>
                        <td class="lista-productos-subtitle" style="visibility: hidden">Borrar</td>
                    </tr>
                    @foreach ($productos as $key => $producto)
                        <tr>
                            <td class="productos-text">{{ $producto['descripcion'] }}</td>
                            <td class="productos-text">{{ $producto['cantidad'] }}</td>
                            <td><i class="fas fa-times-circle btn-eliminar-producto"
                                    x-on:click="$wire.subsProduct({{ $key }})" style="cursor: pointer;"></i>
                            </td>
                        </tr>
                    @endforeach
                </table>

            </div>
        </div>
        <div class="modal fade" id="myModalDesk" style="background: rgba(0, 0, 0, 0.5); backdrop-filter: blur(5px);">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <!-- Cambia modal-lg a modal-md o modal-sm aquí -->
                <div class="modal-content">
                    <!-- The Close Button -->
                    <div class="text-right">
                        <button type="button" class="close" data-dismiss="modal"
                            style="font-size: 50px; color: red; padding-right:5px;">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body d-flex justify-content-center">
                        <img class="img-fluid" id="img01Desk" style="max-width: 65%; height: auto;">
                    </div>
                </div>
            </div>
        </div>

        <div class="desk-right-cont">
            <div class="factura-img-main-desk">
                <label for="">Referencia factura:</label>
                <div class="factura-img-cont-desk">
                    <img id="myImgDesk" wire:loading.class="disabled"
                        @if ($canal) src="{{ asset("assets/facturas/$canal->ejemplo_factura") }}" @endif
                        alt="">
                </div>
            </div>
        </div>
    </div>
    <div class="puntos-sumados-cont">
        Puntos sumados: {{ $puntos }}
    </div>
    <div class="facturas-selfie-foto-cont">
        <div class="foto-factura-cont">
            <label for="foto_factura">Foto factura:</label>
            <input type="file" id="foto_factura" accept="image/*" capture="user" style="display: none;">
            <label for="foto_factura" class="custom-file-upload" id="imagePreview"
                style="{{ $foto_factura && !$errors->first('foto_factura') ? 'background-image: url(' . $foto_factura->temporaryUrl() . '); background-size: 75%;' : '' }}">
            </label>
            @error('foto_factura')
                <div class="text-invalid-factura">
                    {{ $message }}
                </div>
            @enderror
            <div wire:loading wire:target="foto_factura">
                Cargando...
            </div>
        </div>
        <div class="foto-selfie-cont">
            <label for="foto_selfie">Selfie con producto:</label>
            <input type="file" id="foto_selfie" accept="image/*" capture="user" style="display: none;">
            <label for="foto_selfie" class="custom-file-upload" id="imagePreview"
                style="{{ $selfie_producto && !$errors->first('selfie_producto') ? 'background-image: url(' . $selfie_producto->temporaryUrl() . '); background-size: 75%;' : '' }}">
            </label>
            @error('selfie_producto')
                <div class="text-invalid-factura">
                    {{ $message }}
                </div>
            @enderror
            <div wire:loading wire:target="selfie_producto">
                Cargando...
            </div>
        </div>
    </div>
    @error('limite-puntos')
        <div class="text-danger">
            {{ $message }}
        </div>
    @enderror
    <div class="registrar-factura-btn">
        <button x-on:click="$wire.storeFactura" id="registrar_factura">REGISTRAR FACTURA</button>
    </div>
</div>
@script
    <script>
        @if (session('register-success'))
            dataLayer.push({
                'event': 'GAEvent',
                'event_category': 'Form',
                'event_action': 'Success',
                'event_label': 'Registro_exitoso',
                'interaction': 'true',
                'component_name': 'btn_success_form',
                'campaign_description': 'Budpass'
            });
        @endif

        document.getElementById('foto_factura').addEventListener('click', function() {
            dataLayer.push({
                'event': 'GAEvent',
                'event_category': 'Content',
                'event_action': 'button',
                'event_label': 'Subir_factura',
                'interaction': 'true',
                'component_name': 'btn_subir_factura',
                'element_text': 'Subir_factura',
                'campaign_description': 'Budpass',
            });
        });

        document.getElementById('foto_selfie').addEventListener('click', function() {
            dataLayer.push({
                'event': 'GAEvent',
                'event_category': 'Content',
                'event_action': 'button',
                'event_label': 'Subir_foto',
                'interaction': 'true',
                'component_name': 'btn_subir_foto',
                'element_text': 'Subir_foto_selfie_producto',
                'campaign_description': 'Budpass',
            });
        });

        //registrar_factura

        document.getElementById('registrar_factura').addEventListener('click', function() {
            dataLayer.push({
                'event': 'GAEvent',
                'event_category': 'Content',
                'event_action': 'button',
                'event_label': 'Registrar_factura',
                'interaction': 'true',
                'component_name': 'btn_registrar_factura',
                'element_text': 'Registrar_factura',
                'campaign_description': 'Budpass',
            });
        });

        const MAX_WIDTH = 1020;
        const MAX_HEIGHT = 980;
        const MIME_TYPE = "image/jpeg";
        const QUALITY = 0.9;

        const foto_factura = document.getElementById("foto_factura");
        const foto_selfie = document.getElementById("foto_selfie");

        foto_factura.onchange = function(ev) {
            const file = ev.target.files[0]; // get the file
            const blobURL = URL.createObjectURL(file);
            const img = new Image();
            img.src = blobURL;
            img.onerror = function() {
                URL.revokeObjectURL(this.src);
                // Handle the failure properly
                console.err("Cannot load image");
            };
            img.onload = function() {
                URL.revokeObjectURL(this.src);
                const [newWidth, newHeight] = calculateSize(img, MAX_WIDTH, MAX_HEIGHT);
                const canvas = document.createElement("canvas");
                canvas.width = newWidth;
                canvas.height = newHeight;
                const ctx = canvas.getContext("2d");
                ctx.drawImage(img, 0, 0, newWidth, newHeight);
                canvas.toBlob(
                    blob => {
                        upload_foto_factura(blob);
                    },
                    MIME_TYPE,
                    QUALITY);
            };
        };

        foto_selfie.onchange = function(ev) {
            const file = ev.target.files[0]; // get the file
            const blobURL = URL.createObjectURL(file);
            const img = new Image();
            img.src = blobURL;
            img.onerror = function() {
                URL.revokeObjectURL(this.src);
                // Handle the failure properly
                console.err("Cannot load image");
            };
            img.onload = function() {
                URL.revokeObjectURL(this.src);
                const [newWidth, newHeight] = calculateSize(img, MAX_WIDTH, MAX_HEIGHT);
                const canvas = document.createElement("canvas");
                canvas.width = newWidth;
                canvas.height = newHeight;
                const ctx = canvas.getContext("2d");
                ctx.drawImage(img, 0, 0, newWidth, newHeight);
                canvas.toBlob(
                    blob => {
                        upload_foto_selfie(blob);
                    },
                    MIME_TYPE,
                    QUALITY);
            };
        };

        function calculateSize(img, maxWidth, maxHeight) {
            let width = img.width;
            let height = img.height;

            // calculate the width and height, constraining the proportions
            if (width > height) {
                if (width > maxWidth) {
                    height = Math.round(height * maxWidth / width);
                    width = maxWidth;
                }
            } else {
                if (height > maxHeight) {
                    width = Math.round(width * maxHeight / height);
                    height = maxHeight;
                }
            }

            return [width, height];
        }

        function upload_foto_factura(file) {
            $wire.upload('foto_factura', file, (uploadedFilename) => {});
        }

        function upload_foto_selfie(file) {
            $wire.upload('selfie_producto', file, (uploadedFilename) => {});
        }
    </script>
@endscript
