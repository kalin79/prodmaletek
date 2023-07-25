
<div class="row">
    <div class="col-sm">
        <div class="table-wrap">
            <div class="table-responsive">
                <table class="table table-striped mb-0">
                    <thead >
                    <tr>
                        <th>Categoria</th>
                        <th>Producto</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($relacionadas as $relacionada)
                        <tr>
                            <td>{{ $relacionada->producto->categoria? $relacionada->producto->categoria->name : '' }}</td>
                            <td>{{ $relacionada->producto->title_large}}</td>

                            @if($relacionada->active)
                                <td><span class="badge badge-success">Activo</span></td>
                            @else
                                <td><span class="badge badge-danger">No-Activo</span></td>
                            @endif
                            <td>

                                <button  onclick="eliminar({{ $relacionada->id }},'{{route("products.relacionada.destroy",$relacionada->id)}}')" title="Eliminar" class="btn btn-outline-danger btn-sm" data-id="{{ $relacionada->id }}">
                                    <i class="fa fa-trash"></i>
                                </button> &nbsp;
                                @if($relacionada->active)
                                    <button  onclick="desactivar({{ $relacionada->id }},'{{route("products.relacionada.desactive")}}')" title="Desactivar" data-id="{{ $relacionada->id }}" class="btn btn-outline-warning btn-sm" >
                                        <i class="fa fa-ban"></i>
                                    </button>
                                @else

                                    <button  onclick="activar({{ $relacionada->id }},'{{route("products.relacionada.active")}}')" title="Activar" data-id="{{ $relacionada->id }}" class="btn btn-outline-success  btn-sm">
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
                        <td colspan="3">{{ $relacionadas->links() }}</td>
                        <td><span>Total: </span> <b>{{ $relacionadas->total() }}</b></td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
