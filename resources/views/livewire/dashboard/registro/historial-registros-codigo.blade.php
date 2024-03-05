<div>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <th>C&oacute;digo</th>
                <th>Puntos sumados</th>
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
        {{ $registrosCodigo->links()}}
    </div>
</div>
