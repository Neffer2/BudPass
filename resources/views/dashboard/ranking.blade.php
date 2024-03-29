@extends('layouts.app')
@section('title', 'Ranking')
@section('content')

    <div class="ranking-main-cont">

        <div class="ranking-table-cont">
            <div class="ranking-title">
                <h1>
                    Ranking Final
                    <i class="fas fa-info-circle" id="infoRankingFinal"></i>
                </h1>
            </div>
            <div class="scrollable-table">
            <table>
                <thead>
                    <tr>
                        <th>Puesto</th>
                        <th>Nombre</th>
                        <th>Puntuación</th>
                        <th>Última Carga</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ranking as $key => $participante)
                        <tr>
                            <td>{{ $key += 1 }}</td>
                            <td> {{ $participante->name }} </td>
                            <td> {{ $participante->puntos }} </td>
                            <td> {{ $participante->updated_at }} </td>
                        </tr>
                    @endforeach
                    {{-- @if (Auth::user()->estado_id == 1)
                        <tr class="ranking-usuario-table">
                            <td>{{ $user_rank }}</td>
                            <td>{{ Auth::user()->name }}</td>
                            <td>{{ Auth::user()->puntos }}</td>
                            <td> - </td>
                        </tr>
                    @endif --}}
                </tbody>
            </table>
            </div>
        </div>
        <div class="ranking-puntaje-acum">
            @include('puntaje')
        </div>

    </div>
@endsection
