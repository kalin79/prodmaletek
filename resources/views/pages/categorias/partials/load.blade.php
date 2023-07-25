<input type="hidden" id="parent_id" value="{{$parent_id}}">
<table id="tbl-slider" class="table table-striped mb-0">
    <thead>
        <tr>

            <th width="200px">Poster</th>
            <th>Nombre</th>
            <th >Estado</th>
            <th width="150px">Opciones</th>
        </tr>
    </thead>
<tbody>
    @forelse ($categorias as $categoria)
        <tr id="{{$categoria->id}}">
            @if($parent_id==0)
                <td>
                    @if($categoria->poster )
                    <img src="/images/categorias/{{$categoria->id}}/{{ $categoria->poster }}" alt="item.name"
                        width="80px">
                    @endif
                </td>
            @endif
            <td>
                {{ $categoria->name }}

            </td>


            @if ($categoria->active)
                <td><span class="badge badge-success">Activo</span></td>
            @else
                <td><span class="badge badge-danger">No-Activo</span></td>
            @endif
            <td width="150px">

                <a title="Editar" data-name="{{ $categoria->name }}" href="{{ route('categories.edit', $categoria->id) }}"
                    class="btn btn-outline-info btn-sm edit-entity">
                    <i class="fa fa-pen"></i>
                </a> &nbsp;
                <button onclick="eliminar({{ $categoria->id }},'{{ route('categories.destroy', $categoria->id) }}')"
                    title="Dar de baja" class="btn btn-outline-danger btn-sm" data-id="{{ $categoria->id }}">
                    <i class="fa fa-trash"></i>
                </button> &nbsp;
                @if ($categoria->active == 1)
                    <button onclick="desactivar({{ $categoria->id }},'{{ route('categories.desactive') }}')" title="Desactivar"
                        data-id="{{ $categoria->id }}" class="btn btn-outline-warning btn-sm">
                        <i class="fa fa-ban"></i>
                    </button>
                @else

                    <button onclick="activar({{ $categoria->id }},'{{ route('categories.active') }}')" title="Activar"
                        data-id="{{ $categoria->id }}" class="btn btn-outline-success  btn-sm">
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
        <td colspan="{{$parent_id == 0 ? '3' : '2'}}">{{ $categorias->links() }}</td>
        <td><span>Total: </span> <b>{{ $categorias->total() }}</b></td>
    </tr>
</tfoot>
</table>
