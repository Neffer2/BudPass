@extends('layouts.app')
@section('content')
    <div class="main-facturas-cont">
        <div class="big-logo-facturas-cont">
            <div class="big-logo-facturas"></div> {{-- cambiar --}}
        </div>
        <div class="facturas-codigos-cont">

            <div class="form-facturas-btn">
                <button id="show-facturas-btn" class="facturas-codigos-btn">Registrar facturas</button>
                <button id="show-codigo-btn" class="facturas-codigos-btn secundario-btn">Registrar códigos</button>
            </div>
            <div class="registro-factura-form">
                <livewire:dashboard.registro-facturas />
            </div>
            <br><br>
            <div class="registro-codigo-form" style="display: none;">
                <livewire:dashboard.registro-codigo />
            </div>
            <br><br>
            <div class="puntaje-ac">
                PUNTAJE ACUMULADO
                {{ Auth::user()->puntos }} PTS <br>
                PUNTAJE PENDIENTE
                {{ Auth::user()->puntos }}
            </div>
        </div>
    </div>

@endsection
