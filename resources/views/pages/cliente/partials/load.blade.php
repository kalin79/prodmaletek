
<div class="row">
    <div class="col-sm">
        <div class="table-wrap">
            <div class="table-responsive">
                <table class="table table-striped mb-0">
                    <thead >
                        <tr>
                            <th>Socio</th>
                            <th>DNI</th>
                            <th>Vocativo</th>
                            <th>Campaña</th>
                            <th>Cumpleaños </th>
                            <th>Tipo tarjeta </th>
                            <th>Ingreso </th>
                            <th>Fecha ingreso </th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse ($clientes as $cliente)
                        <tr>
                            <td>{{ $cliente->nombre }}</td>
                            <td>{{ $cliente->nro_documento}} </td>
                            <td>{{$cliente->vocativo}}</td>
                            <td>{{ $cliente->campana}} </td>
                            <td>{{$cliente->cumpleanos}}</td>
                            <td>{{$cliente->tipo_tarjeta}}</td>
                            <td>{{$cliente->ingreso==1?'SI':'NO'}}</td>
                            <td>{{$cliente->fecha_ingreso}}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted"><span>No se encontraron resultados</span></td>
                        </tr>
                    @endforelse

                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="7">{{ $clientes->links() }}</td>
                            <td><span>Total: </span> <b>{{ $clientes->total() }}</b></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
