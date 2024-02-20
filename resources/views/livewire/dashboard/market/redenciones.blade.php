<div class="container">
    <h2 class="text-center">Tus redenciones</h2>
    <table>
        <tr>
            <th>Premio</td>
            <th>Puntos</th>
            <th>Fecha</th>
        </tr>
        @foreach ($redenciones as $redencion) 
            <tr>
                <td>{{ $redencion->premio->nombre }}</td>
                <td>{{ $redencion->premio->puntos }}</td>
                <td>{{ $redencion->created_at }}</td>
            </tr>
        @endforeach
    </table>

    {{ $redenciones->links() }}
</div>
 