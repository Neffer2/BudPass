<div class="codigos-historial-container">
    <h1>Códigos registrados</h1>
    <table>
        <thead>
            <th>C&oacute;digo</th>
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
</div>
