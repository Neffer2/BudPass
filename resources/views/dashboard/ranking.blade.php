@extends('layouts.app')
@section('title', 'Ranking')
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
                        <th>Ultima Carga</th>
                    </tr>
                </thead>
                <tbody>
                        <tr>
                            <td>1</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td>7</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td>9</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td>10</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>

                    @if (Auth::user()->estado_id == 1)
                        <tr class="ranking-usuario-table">
                            <td> - </td>
                            <td>{{ Auth::user()->name }}</td>
                            <td>{{ Auth::user()->puntos }}</td>
                            <td>-</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="ranking-puntaje-acum">
            @include('puntaje')
        </div>

    </div>
@endsection
