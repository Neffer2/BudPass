<div>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <th>Factura</th>
                <th>Canal</th>
                <th>Puntos sumados</th>
                <th>Estado</th>
            </thead>
            <tbody>
                @foreach ($registrosFactura as $registroFactura)
                    <tr>
                        <td>{{ $registroFactura->num_factura }}</td>
                        <td>{{ $registroFactura->canal->descripcion }}</td>
                        <td>{{ $registroFactura->puntos_sumados }}</td>
                        <td>{{ $registroFactura->estado_id }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $registrosFactura->links()}}
    </div>
</div>
