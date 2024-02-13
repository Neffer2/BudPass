@extends('layouts.admin')
    @section('title')
        {{ $user->name }}
    @endsection
    @section('content')
        @livewire('admin.factura', ['registroFactura' => $registroFactura])
    @endsection