@extends('layouts.app')
    @section('content')

        <h2>RANKING</h2>
        @foreach ($ranking as $key => $participante)
            {{ $key+=1 }}
            {{ $participante->name }}
            {{ $participante->puntos }}
            <br>
        @endforeach
        <br>
        <div style="background-color: red">
            @if(Auth::user()->estado_id == 1)
                {{ $user_rank }} {{ Auth::user()->name }} {{ Auth::user()->puntos }}
            @endif
        </div>
    @endsection