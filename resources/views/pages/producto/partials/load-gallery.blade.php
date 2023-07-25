<table id="tbl-slider" class="table table-striped mb-0">
    <thead>
        <tr>
            <th>Imagen</th>
            <th>Orden</th>
            <th>Opciones</th>
        </tr>
    </thead>
<tbody>
    @forelse ($gallery as $image)
        <tr id="{{$image->id}}">
            <td>
                @if($image->image)
                <img src="{{ asset('images/products') }}/{{ $product->id }}/{{ $image->image }}"
                    width="200px">
                @endif
            </td>
            <td>
                {{ $image->order }}
            </td>

            <td width="150px">
                <button type="button" onclick="eliminarImageGallery({{ $image->id }},'{{ route('products.gallery.destroy', [$product->id,$image->id]) }}')"
                    title="eliminar" class="btn btn-outline-danger btn-sm" data-id="{{ $image->id }}">
                    <i class="fa fa-trash"></i>
                </button>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="6" class="text-center text-muted"><span>No se encontraron resultados</span></td>
        </tr>
    @endforelse

</tbody>
</table>
