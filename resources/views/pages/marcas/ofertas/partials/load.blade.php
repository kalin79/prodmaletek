
<div class="row">
    <div class="col-sm">
        <div class="table-wrap">
            <div class="table-responsive">
                <table class="table table-striped mb-0">
                    <thead >
                        <tr>
                            <th>Oferta</th>
                            <th>TyC</th>
                            <th>Estado </th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse ($ofertas as $oferta)
                        <tr>
                            <td>{{ $oferta->oferta }}</td>
                            <td>{{ $oferta->terminos_condiciones }}</td>
                            @if($oferta->active)
                            <td><span class="badge badge-success">Activo</span></td>
                            @else
                            <td><span class="badge badge-danger">No-Activo</span></td>
                            @endif

                            <td >
                                <a title="Editar" data-name="{{$oferta->oferta}}"  href="{{ route('marca.oferta.edit', $oferta->id) }}" class="btn btn-outline-info btn-sm edit-entity" >
                                    <i class="fa fa-pen"></i>
                                </a> &nbsp;
                                @if($oferta->active==1)
                                    <button  onclick="desactivar({{ $oferta->id }},'{{route("marca.oferta.desactive")}}')" title="Desactivar" data-id="{{ $oferta->id }}" class="btn btn-outline-warning btn-sm" >
                                        <i class="fa fa-ban"></i>
                                    </button>
                                @else

                                    <button  onclick="activar({{ $oferta->id }},'{{route("marca.oferta.active")}}')" title="Activar" data-id="{{ $oferta->id }}" class="btn btn-outline-success  btn-sm">
                                        <i class="fa fa-check "></i>
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted"><span>No se encontraron resultados</span></td>
                        </tr>
                    @endforelse

                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3">{{ $ofertas->links() }}</td>
                            <td><span>Total: </span> <b>{{ $ofertas->total() }}</b></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
