<div>
    <div>
        <img @if ($canal) src="{{ asset("assets/canales/$canal->logo") }}" @endif alt="" height="100">
        <img @if ($canal) src="{{ asset("assets/facturas/$canal->ejemplo_factura") }}" @endif alt="" height="100">                    
    </div>
    <hr>
    <div>
        <label for="">NIT</label>
        <input type="text" wire:model.live.debounce.500ms="nit">
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
    <hr>
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
                <div class="text-invalid">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div>
            <label for="">Cantidad</label>
            <input type="number" wire:model.change='cantidad'>
            @error('cantidad')
                <div class="text-invalid">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div>
            <button x-on:click="$wire.addProduct()">Agregar</button>
        </div>
    </div>
    <hr>
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
                    <td>{{ $key+=1 }}</td>
                    <td>{{ $producto['descripcion'] }}</td>
                    <td>{{ $producto['cantidad'] }}</td>
                    <td><button x-on:click="$wire.subsProduct({{ $key-=1 }})">x</button></td>
                </tr>                
            @endforeach
        </table>
    </div>
    <hr>
    <div>
        Puntos sumados: {{ $puntos }}
    </div>
    <hr>
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
