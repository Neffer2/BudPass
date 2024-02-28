@extends('layouts.admin')
    @section('title')
        {{ Auth::user()->name }}
    @endsection
    @section('content')
        <div class="container">
            @if (session('success'))
                <div class="alert alert-success mt-2" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger mt-2" role="alert">
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif

            @livewire('admin.buscar')
            <div class="row gy-2">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Facturas</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Num Factura</th>
                                            <th>Canal</th>
                                            <th>NIT</th>
                                            <th>Usuario</th>
                                            <th>Puntos</th>
                                            <th>Fecha</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($registrosFactura as $key => $registros)
                                            <tr>
                                                <td>{{ $key+=1 }}</td>
                                                <td>{{ $registros->num_factura }}</td>
                                                <td>{{ $registros->canal->descripcion }}</td> 
                                                <td>{{ $registros->canal->nit }}</td> 
                                                <td>{{ $registros->shopper->name }}</td> 
                                                <td>{{ $registros->puntos_sumados }}</td> 
                                                <td>{{ $registros->created_at }}</td> 
                                                <td>
                                                    <a href="{{ route('factura', $registros->id) }}" class="btn btn-primary">Ver mas</a>
                                                </td> 
                                            </tr>                                    
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{ $registrosFactura->links() }}
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Redenciones</h4> 
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead> 
                                        <tr>
                                            <th>#</th>
                                            <th>Usuario</th>
                                            <th>Documento</th>
                                            <th>Premio</th>
                                            <th>Fecha</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody> 
                                        @foreach ($redenciones as $key => $redencion)
                                            <tr>
                                                <td>{{ $key+=1 }}</td>
                                                <td>{{ $redencion->shopper->name }}</td>
                                                <td>{{ $redencion->shopper->documento }}</td>
                                                <td>{{ $redencion->premio->nombre }}</td>
                                                <td>{{ $redencion->created_at }}</td>
                                                <td>
                                                    @if ($redencion->estado_id == 1)
                                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal{{ $redencion->id }}">
                                                            Entregar
                                                        </button>
                                                    @else
                                                        <button disabled class="btn btn-secondary">Entregado</button>
                                                    @endif
                                                </td>
                                            </tr> 
                                            <!-- Modal -->
                                            <div class="modal fade" id="modal{{ $redencion->id }}" tabindex="-1" aria-labelledby="modal{{ $redencion->id }}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">  
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            ¿Deseas marcar esta redenci&oacute;n como entregada?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                            <a href="{{ route('redencion', $redencion->id) }}" class="btn btn-success">Entregar</a> 
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>                                  
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{ $redenciones->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection 