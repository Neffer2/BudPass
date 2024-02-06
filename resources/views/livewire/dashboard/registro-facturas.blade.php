<div>
    <div>
        <label for="">NIT</label>
        <input type="text" wire:model.change="nit">
        <img src="{{ asset('assets/canales/can_exito.jpg') }}" alt="" height="100">
        @error('nit')
            <div class="text-invalid">
                {{ $message }}
            </div>
        @enderror
    </div> 
    <br>
    <div>
        <label for="">FACTURA</label>
        <input type="text"> 
        <img x-bind:src="{{ asset('assets/facturas/${$wire.canal.logo}') }}" alt="" height="100">            
    </div>
    <br>
    <div>
        <label for="">Listado de productos</label>
        <table>
            <tr>
                <td>Producto</td>
                <td>Cantidad</td>
            </tr>
            <tr>
                <td>Producto 1</td>
                <td>5</td>
                <td><button>x</button></td>
            </tr>
        </table>
    </div>
    <div>
        <img src="" alt="">
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
