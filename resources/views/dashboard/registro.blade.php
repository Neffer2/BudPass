@extends('layouts.app')
@section('content')
    <div class="main-facturas-cont">
        <div class="big-logo-facturas-cont">
            <div class="big-logo-facturas"></div> {{-- cambiar --}}
        </div>
        <div class="facturas-codigos">
            <livewire:dashboard.registro-facturas />
            <br><br><br><br>
            <livewire:dashboard.registro-codigo />
            <br><br><br><br>
            <div>
                PUNTAJE ACUMULADO
                {{ Auth::user()->puntos }} PTS <br>
                PUNTAJE PENDIENTE
                {{ Auth::user()->puntos }}
            </div>
        </div>
    </div>
@endsection
