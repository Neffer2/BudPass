<div class="registros-historial-container">
    <h1>Facturas registradas</h1>
    <table>
        <thead>
            <th>Factura</th>
            <th>Canal</th>
            <th>Puntos</th>
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
    {{ $registrosFactura->links() }}
</div>

<script>
    
</script>
