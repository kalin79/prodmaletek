<div class="tab-content">
    <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
        <div class="main-card mb-3 card">
            <div class="mb-1 card  m-0 p-0">
                <div class="card-header">
                    <ul class="nav nav-justified">
                        <li class="nav-item">
                            <a data-toggle="tab" href="#tab-eg7-0" class="nav-link active">Soles</a>
                        </li>
                        <li class="nav-item">
                            <a data-toggle="tab" href="#tab-eg7-1" class="nav-link">Dolares</a>
                        </li>
                    </ul>
                </div>
            </div>



            <div class="card-body ">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab-eg7-0" role="tabpanel">
                        <div class="table-wrap">
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
                                    <thead >
                                    <tr>
                                        <th>Local</th>
                                        <th>Monto T.</th>
                                        <th>Cuota</th>
                                        <th>Saldo</th>
                                        <th>N° de compras seleccionadas </th>
                                        <th>Tasa nueva</th>
                                        <th>N° de cuotas nuevo</th>
                                        <th>Importe total</th>
                                        <th>Nueva glosa</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse ($compras_soles as $compra_soles)
                                        <tr>
                                            <td>{{$compra_soles->glosa}}</td>
                                            <td>
                                                S/{{$compra_soles->importe_trax}}
                                            </td>
                                            <td>
                                                {{$compra_soles->cuotas_pagada}}/{{$compra_soles->total_cuotas}}
                                            </td>
                                            <td>
                                                S/{{$compra_soles->saldo_actual}}
                                            </td>
                                            <td>{{$compra_soles->refinanciamiento? ( $compra_soles->refinanciamiento->refinanciemintoCabecera? $compra_soles->refinanciamiento->refinanciemintoCabecera->nro_compras: '') : ''}}</td>
                                            <td>{{$compra_soles->refinanciamiento? ( $compra_soles->refinanciamiento->refinanciemintoCabecera? $compra_soles->refinanciamiento->refinanciemintoCabecera->tasa: '') : ''}}</td>
                                            <td>{{$compra_soles->refinanciamiento? ( $compra_soles->refinanciamiento->refinanciemintoCabecera? $compra_soles->refinanciamiento->refinanciemintoCabecera->nro_cuotas: '') : ''}}</td>
                                            <td>{{$compra_soles->refinanciamiento? ( $compra_soles->refinanciamiento->refinanciemintoCabecera? $compra_soles->refinanciamiento->refinanciemintoCabecera->total_refinanciar: '') : ''}}</td>
                                            <td>{{$compra_soles->refinanciamiento? ( $compra_soles->refinanciamiento->refinanciemintoCabecera? $compra_soles->refinanciamiento->refinanciemintoCabecera->nueva_glosa: '') : ''}}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center text-muted"><span>No se encontraron resultados</span></td>
                                        </tr>
                                    @endforelse

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="8"></td>
                                            <td><span>Total: </span> <b>{{ count($compras_soles) }}</b></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                    </div>
                    <div class="tab-pane" id="tab-eg7-1" role="tabpanel">
                        <div class="table-wrap">
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
                                    <thead >
                                    <tr>
                                        <th>Local</th>
                                        <th>Monto T.</th>
                                        <th>Cuota</th>
                                        <th>Saldo</th>
                                        <th>N° de compras seleccionadas </th>
                                        <th>Tasa nueva</th>
                                        <th>N° de cuotas nuevo</th>
                                        <th>Importe total</th>
                                        <th>Nueva glosa</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse ($compras_dolares as $compra_dolares)
                                        <tr>
                                            <td>{{$compra_dolares->glosa}}</td>
                                            <td>
                                                ${{$compra_dolares->importe_trax}}
                                            </td>
                                            <td>
                                               {{$compra_dolares->cuotas_pagada}}/{{$compra_dolares->total_cuotas}}
                                            </td>
                                            <td>
                                                ${{$compra_dolares->saldo_actual}}
                                            </td>
                                            <td>{{$compra_dolares->refinanciamiento? ( $compra_dolares->refinanciamiento->refinanciemintoCabecera? $compra_dolares->refinanciamiento->refinanciemintoCabecera->nro_compras: '') : ''}}</td>
                                            <td>{{$compra_dolares->refinanciamiento? ( $compra_dolares->refinanciamiento->refinanciemintoCabecera? $compra_dolares->refinanciamiento->refinanciemintoCabecera->tasa: '') : ''}}</td>
                                            <td>{{$compra_dolares->refinanciamiento? ( $compra_dolares->refinanciamiento->refinanciemintoCabecera? $compra_dolares->refinanciamiento->refinanciemintoCabecera->nro_cuotas: '') : ''}}</td>
                                            <td>{{$compra_dolares->refinanciamiento? ( $compra_dolares->refinanciamiento->refinanciemintoCabecera? $compra_dolares->refinanciamiento->refinanciemintoCabecera->total_refinanciar: '') : ''}}</td>
                                            <td>{{$compra_dolares->refinanciamiento? ( $compra_dolares->refinanciamiento->refinanciemintoCabecera? $compra_dolares->refinanciamiento->refinanciemintoCabecera->nueva_glosa: '') : ''}}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center text-muted"><span>No se encontraron resultados</span></td>
                                        </tr>
                                    @endforelse

                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td colspan="8"></td>
                                        <td><span>Total: </span> <b>{{ count($compras_dolares) }}</b></td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

    </div>
</div>
