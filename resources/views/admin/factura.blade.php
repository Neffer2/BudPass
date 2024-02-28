@extends('layouts.admin')
    @section('title')
        {{ Auth::user()->name }}
    @endsection
    @section('content')
        @livewire('admin.factura', ['registroFactura' => $registroFactura])
    @endsection