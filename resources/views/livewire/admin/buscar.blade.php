<div class="mt-5 mb-2">
    <div class="row">
        <div class="col-3">
            <input type="text" class="form-control" placeholder="Documento" wire:model.change="documento">
        </div>
        <div class="col-3">
            <input type="text" class="form-control" placeholder="Celular" wire:model.change="telefono">
        </div>
        <div class="col-3">
            <input type="text" class="form-control" placeholder="Correo" wire:model.change="email">
        </div>
        <div class="col-3">
            <button wire:click='search' class="btn btn-primary">Buscar</button>
        </div>
    </div>
    @if ($user)
        <div class="row mt-2">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h6>{{ $user->name }}</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Documento</th>
                                        <th>Telefono</th>
                                        <th>Ciudad</th>
                                        <th>Correo</th>
                                        <th>Puntos</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->documento }}</td>
                                        <td>{{ $user->telefono }}</td>
                                        <td>{{ $user->ciudad->descripcion }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->puntos }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row px-3 mb-2">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h6>Registros</h6>
                                </div>
                                <div class="card-body">
                                    <h6>Facturas</h6>
                                    <div class="table-responsive" style="max-height: 183px !important">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Número</th>
                                                    <th>Canal</th>
                                                    <th>Selfie</th>
                                                    <th>Factura</th>
                                                    <th>Puntos</th>
                                                    <th>Estado</th>                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($user->registrosFactura as $key => $registro)
                                                    <tr>
                                                        @php
                                                            $foto_factura = str_replace('public/', '', $registro->foto_factura);
                                                            $foto_selfie = str_replace('public/', '', $registro->foto_selfie);
                                                        @endphp
                                                        <td>{{ $key+=1 }}</td>
                                                        <td>{{ $registro->num_factura }}</td>
                                                        <td>{{ $registro->canal->descripcion }}</td>
                                                        <td><a href="{{ asset("storage/$foto_factura") }}" target="_blank">Ver</a></td>
                                                        <td><a href="{{ asset("storage/$foto_selfie") }}" target="_blank">Ver</a></td>
                                                        <td>{{ $registro->puntos_sumados }}</td>
                                                        <td>
                                                            @if ($registro->estado_id == 1) Aprobada @elseif($registro->estado_id == 0) Rechazada @elseif($registro->estado_id == 2) En revisi&oacute;n @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <hr>
                                    <h6>C&oacute;digos</h6>
                                    <div class="table-responsive" style="max-height: 183px !important">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>C&oacute;digo</th>
                                                    <th>Puntos</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($user->registrosCodigo as $key => $registro)
                                                    <tr>
                                                        <td>{{ $key+=1 }}</td>
                                                        <td>{{ $registro->codigo->codigo }}</td>
                                                        <td>{{ $registro->puntos_sumados }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h6>Redenciones</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive" style="max-height: 183px !important">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Premio</th>
                                                    <th>Puntos</th>
                                                    <th>Estado</th>                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($user->redenciones as $key => $redencion)
                                                    <tr>
                                                        <td>{{ $key+=1 }}</td>
                                                        <td>{{ $redencion->premio->nombre }}</td>
                                                        <td>- {{ $redencion->premio->puntos }}</td>
                                                        <td>
                                                            @if ($registro->estado_id == 1) Aprobada @elseif($registro->estado_id == 0) Rechazada @elseif($registro->estado_id == 2) En revisi&oacute;n @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
    @endif
</div> 