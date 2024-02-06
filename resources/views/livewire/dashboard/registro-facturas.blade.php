<div>
    <div>
        <img @if ($canal) src="{{ asset("assets/canales/$canal->logo") }}" @endif alt="" height="100">
        <img @if ($canal) src="{{ asset("assets/facturas/$canal->ejemplo_factura") }}" @endif alt="" height="100">                    
    </div>
    <div>
        <label for="">NIT</label>
        <input type="text" wire:model.live.debounce.150ms="nit">
        @error('nit')
            <div class="text-invalid">
                {{ $message }}
            </div>
        @enderror
    </div> 
    <div>
        <label for="">FACTURA</label>
        <input type="text" wire:model.change="num_factura">
        @error('num_factura')
            <div class="text-invalid">
                {{ $message }}
            </div>
        @enderror
    </div>
    <br>
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
        </div>
        <div>
            <label for="">Cantidad</label>
            <input type="number" wire:model.change='cantidad'>
        </div>
        <div>
            <button x-on:click="$wire.addProduct()">Agregar</button>
        </div>
    </div>
    <br>
    <div>
        <label for="">Listado de productos</label>
        <table>
            <tr>
                <td>Producto</td>
                <td>Cantidad</td>
            </tr>
            @foreach ($productos as $key => $producto)
                <tr>
                    <td>{{ $key+=1 }}</td>
                    <td>{{ $producto['descripcion'] }}</td>
                    <td><button>x</button></td>
                </tr>                
            @endforeach
        </table>
    </div>
    <br>
    <div>
        <label for="">Foto factura</label>
        <input type="text">
    </div>
    <div>
        <label for="">Selfie con producto</label>
        <input type="text">
    </div>
    <br>
    <div>
        <button>REGISTRAR FACTURA</button>
    </div>
</div>
