<table id="tbl-slider" class="table table-striped mb-0">
    <thead>
    <tr>
        <th>Poster</th>
        <th>Título</th>
        <th>Código</th>
        <th>Categoria</th>
        <th>Estado</th>
        <th>Opciones</th>
    </tr>
    </thead>
    <tbody>
    @forelse ($productos as $producto)
        <tr >
            <td>
                @if($producto->poster)
                    <img src="{{ asset('images/products') }}/{{ $producto->id }}/{{ $producto->poster }}"
                         width="50px">
                @endif
            </td>
            <td>{{ $producto->title_large }}</td>
            <td>{{ $producto->code }}</td>
            <td>{{ $producto->categoria ?$producto->categoria->name : ''  }}</td>


            @if ($producto->active)
                <td><span class="badge badge-success">Activo</span></td>
            @else
                <td><span class="badge badge-danger">No-Activo</span></td>
            @endif
            <td width="150px">

                <button title="Editar" data-name="{{ $producto->title_small }}" onclick="relacionar({{$product->id}},{{$producto->id}})"
                        class="btn btn-outline-primary btn-sm">
                    <i class="fa fa-plus"></i> Agregar
                </button> &nbsp;

            </td>
        </tr>
    @empty
        <tr>
            <td colspan="6" class="text-center text-muted"><span>No se encontraron resultados</span></td>
        </tr>
    @endforelse

    </tbody>
    <tfoot>
    <tr>
        <td colspan="5">{{ $productos->links() }}</td>
        <td><span>Total: </span> <b>{{ $productos->total() }}</b></td>
    </tr>
    </tfoot>
</table>
