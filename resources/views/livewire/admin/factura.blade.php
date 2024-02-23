<div class="container">
    <div class="card mt-5"> 
        <div class="row">
            <div class="col-md-12">
                <div class="card-header">
                    <h4>Infromaci&oacute;n factura</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead> 
                                <tr>
                                    <th>N&uacute;mero</th>
                                    <th>Canal</th>
                                    <th>Puntos sumados</th>
                                    <th>Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $registroFactura->num_factura }}</td>
                                    <td>{{ $registroFactura->canal->descripcion }}</td>
                                    <td>{{ $registroFactura->puntos_sumados }}</td>
                                    <td>{{ $registroFactura->created_at }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card-body">
                    <div class="card-header">
                        <h5>Productos factura</h5> 
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Puntos</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $acum = 0; @endphp
                                @foreach ($registroFactura->productos as $productoFactura)
                                    <tr>
                                        <td>{{ $productoFactura->producto->descripcion }}</td>
                                        <td>{{ $productoFactura->cantidad }}</td>
                                        <td>{{ $productoFactura->producto->referencia->puntos }}</td>
                                    </tr>

                                    @php $acum += $productoFactura->producto->referencia->puntos; @endphp
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2"><b>Total puntos:</b></td>
                                    <td><b>{{ $acum }}</b></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            @php
                $foto_factura = str_replace('public/', '', $registroFactura->foto_factura);
                $foto_selfie = str_replace('public/', '', $registroFactura->foto_selfie);
            @endphp
            <div class="col-md-6">
                <div class="card-body row">
                    <div class="col-6">
                        <h6>Foto factura</h6>
                        <img src="{{ asset("storage/$foto_factura") }}" class="card-img-top" height="200">
                    </div>
                    <div class="col-6">
                        <h6>Foto selfie</h6>
                        <img src="{{ asset("storage/$foto_selfie") }}" class="card-img-top" height="200">
                    </div>
                </div>
            </div>
            <div class="col-md-12 px-2">
                <div class="card-body">
                    <button wire:click="cambioEstado(1)"
                    wire:target="cambioEstado" wire:loading.attr="disabled"
                    wire:confirm="¿Estás seguro de APROBAR esta factura?"
                    class="btn btn-success">Aprobar</button>

                    <button wire:click="cambioEstado(0)"
                    wire:target="cambioEstado" wire:loading.attr="disabled"
                    wire:confirm="¿Estás seguro de RECHAZAR esta factura?"
                    class="btn btn-danger">Rechazar</button>
                </div>
            </div>
        </div>
    </div>
</div>