@extends('layouts.app')
    @section('content')
        @foreach ($premios as $key => $premio)
            {{ $premio->nombre }} <br>
        @endforeach
    @endsection