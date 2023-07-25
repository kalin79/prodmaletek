<table class="table table-striped mb-0">
    <thead >
    <tr>
        <th>NumDoc</th>
        <th>Nombre</th>
        <th>Tipo_Tarjeta</th>
        <th>Campaña</th>
        <th>Fecha_Inscripcion</th>
    </tr>
    </thead>
    <tbody>
    @forelse ($clientes as $cliente)
        <tr>
            <td>{{ $cliente->nro_documento}} </td>
            <td>{{ $cliente->nombre }}</td>
            <td>{{$cliente->tipo_tarjeta}}</td>
            <td>{{ $cliente->campana}} </td>
            <td>{{$cliente->fecha_ingreso_format}}</td>
        </tr>
    @empty
        <tr>
            <td colspan="7" class="text-center text-muted"><span>No se encontraron resultados</span></td>
        </tr>
    @endforelse

    </tbody>

</table>