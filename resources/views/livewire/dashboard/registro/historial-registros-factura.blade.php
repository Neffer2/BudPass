<div class="registros-historial-container">
    <h1>Facturas registradas</h1>
    @if ($registrosFactura->isEmpty())
        <p>No hay facturas registradas.</p>
    @else
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
                        <td>
                            @switch($registroFactura->estado_id)
                                @case(0)
                                    Rechazado
                                @break

                                @case(1)
                                    Aprobado
                                @break

                                @case(2)
                                    En revisión
                                @break

                                @default
                                    Desconocido
                            @endswitch
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $registrosFactura->links() }}
    @endif
</div>
