<div>
    <div>
        <img @if ($canal) src="{{ asset("assets/canales/$canal->logo") }}" @endif alt=""
            height="100">
        <img @if ($canal) src="{{ asset("assets/facturas/$canal->ejemplo_factura") }}" @endif
            alt="" height="100">
    </div>
    <div>
        <label for="">NIT</label>
        <input type="text" wire:model.live.debounce.500ms="nit">
        @error('nit')
            <div class="text-invalid-factura">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div>
        <label for="">NUM FACTURA</label>
        <input type="text" wire:model.change="num_factura">
        @error('num_factura')
            <div class="text-invalid-factura">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div>
        <div>
            <label for="">Producto</label>
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
        <div>
            <label for="">Cantidad</label>
            <input type="number" wire:model.change='cantidad'>
            @error('cantidad')
                <div class="text-invalid-factura">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div>
            <button x-on:click="$wire.addProduct()">Agregar</button>
        </div>
    </div>
    <div>
        <label for="">Listado de productos</label>
        <table>
            <tr>
                <td>#</td>
                <td>Producto</td>
                <td>Cantidad</td>
            </tr>
            @foreach ($productos as $key => $producto)
                <tr>
                    <td>-</td>
                    <td>{{ $producto['descripcion'] }}</td>
                    <td>{{ $producto['cantidad'] }}</td>
                    <td><button x-on:click="$wire.subsProduct({{ $key }})">x</button></td>
                </tr>
            @endforeach
        </table>
    </div>
    <div>
        Puntos sumados: {{ $puntos }}
    </div>
    <div>
        <label for="">Foto factura</label>
        <input type="file" wire:model.live="foto_factura" accept="image/*">
        @error('foto_factura')
            <div class="text-invalid-factura">
                {{ $message }}
            </div>
        @enderror
        @if ($foto_factura && !$errors->first('foto_factura'))
            <img src="{{ $foto_factura->temporaryUrl() }}" height="50">
        @endif
        <div wire:loading wire:target="foto_factura">
            Cargando...
        </div>
    </div>
    <div>
        <label for="">Selfie con producto</label>
        <input type="file" wire:model.live="selfie_producto" accept="image/*">
        @error('selfie_producto')
            <div class="text-invalid-factura">
                {{ $message }}
            </div>
        @enderror
        @if ($selfie_producto && !$errors->first('selfie_producto'))
            <img src="{{ $selfie_producto->temporaryUrl() }}" height="50">
        @endif
        <div wire:loading wire:target="selfie_producto">
            Cargando...
        </div>
    </div>
    <div>
        @error('productos')
            <div class="text-invalid-factura">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div>
        <button wire:click="storeFactura">REGISTRAR FACTURA</button>
    </div>
    @if (session('success'))
        <b>{{ session('success') }}</b>
    @endif
</div>
