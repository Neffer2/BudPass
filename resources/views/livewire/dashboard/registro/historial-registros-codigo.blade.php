<div class="codigos-historial-container">
    <h1>Códigos registrados</h1>
    @if($registrosCodigo->isEmpty())
        <p>No hay códigos registrados.</p>
    @else
        <table>
            <thead>
                <th>Código</th>
                <th>Puntos</th>
            </thead>
            <tbody>
                @foreach ($registrosCodigo as $registroCodigo)
                    <tr>
                        <td>{{ $registroCodigo->codigo->codigo }}</td>
                        <td>{{ $registroCodigo->puntos_sumados }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $registrosCodigo->links() }}
    @endif
</div>
