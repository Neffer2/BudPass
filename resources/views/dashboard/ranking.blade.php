@extends('layouts.app')
    @section('content')

        <h2>RANKGIN</h2>
        @foreach ($ranking as $key => $participante)
            {{ $key+=1 }}
            {{ $participante->name }}
            {{ $participante->puntos }}
            <br>
        @endforeach
        <br>
        <div style="background-color: red">
            {{ $user_rank }} {{ Auth::user()->name }} {{ Auth::user()->puntos }}
        </div>
    @endsection