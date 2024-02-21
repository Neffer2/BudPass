@extends('layouts.app')
@section('content')
    <div class="cont-main-registro-facturas-codigos">
        <div class="main-facturas-cont">
            <div class="paso-cont">
                <div class="paso-facturas-movil">
                    <img src="{{ asset('assets/budweiser/paso-a-paso-movil.svg') }}" alt="" srcset="">
                </div>
                <div class="paso-facturas-desk">
                    <img src="{{ asset('assets/budweiser/paso-a-paso1.svg') }}" alt="" srcset="">
                </div>
                <div class="paso-facturas-desk">
                    <img src="{{ asset('assets/budweiser/paso-a-paso2.svg') }}" alt="" srcset="">
                </div>
                <dibv class="paso-facturas-desk">
                    <img src="{{ asset('assets/budweiser/paso-a-paso3.svg') }}" alt="" srcset="">
                </dibv>
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
                    <livewire:dashboard.registro-codigos />
                </div>

            </div>
        </div>
        <div class="info-puntaje-cont">
            @include('puntaje')
            <div class="items-factura-contaner"><!-- Nombre puede cambiar -->
                <div class="items-img-factura-cont">
                    @for ($i = 0; $i < 9; $i++)
                        <div class="items-img-factura">
                            @if ($i == 4)
                                <img src="{{ asset('assets/budweiser/budpass-logo.jpg') }}" alt="Filler Image">
                            @else
                                <img src="{{ asset('assets/budweiser/budpass-ref' . ($i < 4 ? $i + 1 : $i) . '.jpg') }}"
                                    alt="Dynamic Image">
                            @endif
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
@endsection
