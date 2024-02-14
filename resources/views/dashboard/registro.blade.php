@extends('layouts.app')
@section('content')
    <div class="cont-main-registro-facturas-codigos">
        <div class="main-facturas-cont">
            <div class="big-logo-facturas-cont">
                <div class="big-logo-facturas"></div>
                <div class="big-logo-facturas-desk"></div>
                <div class="big-logo-facturas-desk"></div>
            </div>
            <div class="facturas-codigos-cont">

                <div class="form-facturas-btn">
                    <button id="show-facturas-btn" class="facturas-codigos-btn">Registrar facturas</button>
                    <button id="show-codigo-btn" class="facturas-codigos-btn secundario-btn">Registrar códigos</button>
                </div>
                <div class="registro-factura-form">
                    <livewire:dashboard.registro-facturas />
                </div>
                <div class="registro-codigo-form" style="display: none;">
                    <livewire:dashboard.registro-codigo />
                </div>

            </div>
        </div>
        <div class="info-puntaje-cont">
            <div class="puntaje-ac">
                <div class="puntaje-ac-text">
                    <p class="text-puntaje-ac">PUNTAJE ACUMULADO <span>{{ Auth::user()->puntos }} PTS</span></p>
                    <p class="text-puntaje-pen">PUNTAJE PENDIENTE <span>{{ Auth::user()->puntos }} PTS</span></p>
                </div>
            </div>
            <div class="items-factura-contaner"><!-- Nombre puede cambiar -->
                <div class="items-img-factura-cont">
                    @for ($i = 0; $i < 9; $i++)
                        <div class="items-img-factura"></div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
@endsection
