@extends('layouts.app')
    @section('content')
        PUNTAJE ACUMULADO
        {{ Auth::user()->puntos }} PTS <br>
        PUNTAJE PENDIENTE
        {{ Auth::user()->puntos }}

        <livewire:dashboard.registro-facturas/>          
        <br><br><br><br>
        <livewire:dashboard.registro-codigo/>
    @endsection