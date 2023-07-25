
<table class="table table-striped mb-0">
    <thead >
    <tr>
        <th>Idencuenta</th>
        <th>DNI</th>
        <th>Nombre</th>
        <th>Producto</th>
        <th>FechaTransaccion</th>
        <th>FechaProceso</th>
        <th>CuotasPendiente</th>
        <th>Plan_Cuota</th>
        <th>Tasa</th>
        <th>Saldo pendiente de trx</th>
        <th>Moneda</th>
        <th>ImporteTrx</th>
        <th>CodAutorizacion</th>
        <th>Glosa</th>
        <th>FechaFacturacion</th>
        <th>N° de compras seleccionadas</th>
        <th>Tasa nueva</th>
        <th>N° de cuotas nuevo</th>
        <th>Importe a refinanciar</th>
        <th>Nueva glosa</th>
        <th>Nueva cuota mensual</th>
        <th>Fecha refinanciamiento</th>
        <th>IdRefinanciado</th>
    </tr>
    </thead>
    <tbody>
    @forelse ($compras as $compra)
        <tr>
            <td>{{$compra->cliente->id_cuenta}}</td>
            <td>{{$compra->cliente->nro_documento}}</td>
            <td>{{$compra->cliente->nombre}}</td>
            <td>{{$compra->producto}}</td>
            <td>{{$compra->fecha_transaccion}}</td>
            <td>{{$compra->fecha_proceso}}</td>
            <td>{{$compra->cuotas_pendientes}}</td>
            <td>{{$compra->plan_cuota}}</td>
            <td>{{$compra->tasa}}</td>
            <td>{{$compra->saldo_actual}}</td>
            <td>{{$compra->moneda}}</td>
            <td>
                {{$compra->importe_trax}}
            </td>
            <td>
                {{$compra->codigo_autorizacion}}
            </td>
            <td>{{$compra->glosa}}</td>
            <td>{{$compra->fecha_facturacion}}</td>
            <td>{{$compra->refinanciamiento? ( $compra->refinanciamiento->refinanciemintoCabecera? $compra->refinanciamiento->refinanciemintoCabecera->nro_compras: '') : ''}}</td>
            <td>12%</td>
            <td>{{$compra->refinanciamiento? ( $compra->refinanciamiento->refinanciemintoCabecera? $compra->refinanciamiento->refinanciemintoCabecera->nro_cuotas: '') : ''}}</td>
            <td>{{$compra->refinanciamiento? ( $compra->refinanciamiento->refinanciemintoCabecera? $compra->refinanciamiento->refinanciemintoCabecera->total_refinanciar: '') : ''}}</td>
            <td>{{$compra->refinanciamiento? ( $compra->refinanciamiento->refinanciemintoCabecera? $compra->refinanciamiento->refinanciemintoCabecera->nueva_glosa: '') : ''}}</td>
            <td>{{$compra->refinanciamiento? ( $compra->refinanciamiento->refinanciemintoCabecera? $compra->refinanciamiento->refinanciemintoCabecera->cuota_mensual: '') : ''}}</td>
            <td>{{$compra->refinanciamiento? ( $compra->refinanciamiento->refinanciemintoCabecera? $compra->refinanciamiento->refinanciemintoCabecera->fecha_refinanciamiento: '') : ''}}</td>
            <td>{{$compra->refinanciamiento? ( $compra->refinanciamiento->refinanciemintoCabecera? $compra->refinanciamiento->refinanciemintoCabecera->id: '') : ''}}</td>

        </tr>
    @empty
        <tr>
            <td colspan="9" class="text-center text-muted"><span>No se encontraron resultados</span></td>
        </tr>
    @endforelse

    </tbody>

</table>
