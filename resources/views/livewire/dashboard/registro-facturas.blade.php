<div class="registro-facturas-cont">
    <div class="nit-cont">
        <div class="nit-label-cont">
            <label for="">NIT:</label>
            <input type="text" wire:model.live.debounce.500ms="nit">
        </div>
        <div class="nit-img"><img
                @if ($canal) src="{{ asset("assets/canales/$canal->logo") }}" @endif alt="">
        </div>
    </div>

    @error('nit')
        <div class="text-invalid-factura">
            {{ $message }}
        </div>
    @enderror
    <div class="num-factura-cont">
        <label for="">Número de factura:</label>
        <input type="text" wire:model.change="num_factura">
    </div>
    @error('num_factura')
        <div class="text-invalid-factura">
            {{ $message }}
        </div>
    @enderror
    <div class="factura-img-cont">
        <img @if ($canal) src="{{ asset("assets/facturas/$canal->ejemplo_factura") }}" @endif
            alt="">
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
    </div>
    @error('producto')
        <div class="text-invalid-factura">
            {{ $message }}
        </div>
    @enderror

    <div class="cantidad-agregar-cont">
        <div class="cantidad-productos-cont">
            <label for="">Cantidad: </label>
            <input type="number" wire:model.change='cantidad'>
        </div>
        <div class="agregar-producto-btn-cont">
            <button x-on:click="$wire.addProduct()">Agregar productos</button>
        </div>
    </div>

    @error('cantidad')
        <div class="text-invalid-factura">
            {{ $message }}
        </div>
    @enderror

    <div class="lista-productos-cont">
        <label for="">Listado de productos</label>
        <table>
            <tr>
                <td class="lista-productos-subtitle">Producto</td>
                <td class="lista-productos-subtitle">Cantidad</td>
            </tr>
            @foreach ($productos as $key => $producto)
                <tr>
                    <td class="productos-text">{{ $producto['descripcion'] }}</td>
                    <td class="productos-text">{{ $producto['cantidad'] }}</td>
                    <td><button x-on:click="$wire.subsProduct({{ $key }})"
                            class="btn-eliminar-producto">x</button></td>
                </tr>
            @endforeach
        </table>
    </div>

    <div class="puntos-sumados-cont">
        Puntos sumados: {{ $puntos }}
    </div>
    <div class="facturas-selfie-foto-cont">
        <div class="foto-factura-cont">
            <label for="foto_factura">Foto factura:</label>
            <input type="file" id="foto_factura" wire:model.live="foto_factura" accept="image/*"
                style="display: none;">
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
            <input type="file" id="foto_selfie" wire:model.live="selfie_producto" accept="image/*"
                style="display: none;">
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
        @error('productos')
            <div class="text-invalid-factura">
                {{ $message }}
            </div>
        @enderror

    </div>

    <div class="registrar-factura-btn">
        <button x-on:click="$wire.storeFactura">REGISTRAR FACTURA</button>
    </div>
    @if (session('success'))
        <b>{{ session('success') }}</b>
    @endif
</div>
