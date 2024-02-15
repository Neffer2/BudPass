@extends('layouts.app')
@section('content')
    <div class="ranking-main-cont">

        <div class="ranking-table-cont">
            <div class="ranking-title">
                <h1>Ranking</h1>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Puesto</th>
                        <th>Nombre</th>
                        <th>Puntuación</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ranking as $key => $participante)
                        <tr>
                            <td>{{ $key += 1 }}</td>
                            <td>{{ $participante->name }}</td>
                            <td>{{ $participante->puntos }}</td>
                        </tr>
                    @endforeach
                    @if (Auth::user()->estado_id == 1)
                    <tr class="ranking-usuario-table">
                        <td>{{ $user_rank }}</td>
                        <td>{{ Auth::user()->name }}</td>
                        <td>{{ Auth::user()->puntos }}</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>

        @include('puntaje')
    </div>
@endsection
