<table id="tbl-slider" class="table table-striped mb-0">
    <thead>
        <tr>
            <th width="200px">Imagen</th>
            <th>Título</th>
            <th>Descripción</th>
            <th>Estado</th>
            <th>Opciones</th>
        </tr>
    </thead>
<tbody>
    @forelse ($banners as $banner)
        <tr id="{{$banner->id}}">
            <td>
                @if($banner->poster)
                <img src="{{ asset('images/categories') }}/{{$category->id}}/banners/{{ $banner->id }}/{{ $banner->poster }}"
                     width="200px">
                @endif
            </td>
            <td>
                {{ $banner->title }}
                <br>
                <small>{{ $banner->sub_title }}</small>
            </td>

            <td>{{ $banner->description }}</td>
            @if ($banner->active)
                <td><span class="badge badge-success">Activo</span></td>
            @else
                <td><span class="badge badge-danger">No-Activo</span></td>
            @endif
            <td width="150px">

                <a title="Editar" data-name="{{ $banner->title }}" href="{{ route('category.banner.edit', ['category' => $category->id,'banner' =>  $banner->id]) }}"
                    class="btn btn-outline-info btn-sm edit-entity">
                    <i class="fa fa-pen"></i>
                </a> &nbsp;
                <button onclick="eliminar({{ $banner->id }},'{{ route('category.banner.destroy', [ 'category' => $category->id, 'banner' => $banner->id]) }}')"
                    title="Dar de baja" class="btn btn-outline-danger btn-sm" data-id="{{ $banner->id }}">
                    <i class="fa fa-trash"></i>
                </button> &nbsp;
                @if ($banner->active == 1)
                    <button onclick="desactivar({{ $banner->id }},'{{ route('category.banner.desactive') }}')" title="Desactivar"
                        data-id="{{ $banner->id }}" class="btn btn-outline-warning btn-sm">
                        <i class="fa fa-ban"></i>
                    </button>
                @else

                    <button onclick="activar({{ $banner->id }},'{{ route('category.banner.active') }}')" title="Activar"
                        data-id="{{ $banner->id }}" class="btn btn-outline-success  btn-sm">
                        <i class="fa fa-check "></i>
                    </button>
                @endif
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="5" class="text-center text-muted"><span>No se encontraron resultados</span></td>
        </tr>
    @endforelse

</tbody>
<tfoot>
    <tr>
        <td colspan="4">{{ $banners->links() }}</td>
        <td><span>Total: </span> <b>{{ $banners->total() }}</b></td>
    </tr>
</tfoot>
</table>
