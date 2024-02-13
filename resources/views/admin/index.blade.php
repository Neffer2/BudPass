@extends('layouts.admin')
    @section('title')
        {{ $user->name }}
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
            <div class="card mt-5">
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
                </div>
            </div>
        </div>
    @endsection