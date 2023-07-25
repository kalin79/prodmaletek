<table id="tbl-slider" class="table table-striped mb-0">
    <thead>
        <tr>
            <th>Color</th>
            <th>Imagen</th>
            <th style="margin: auto;text-align:center">Imagen Por Defecto</th>
            <th>Opciones</th>
        </tr>
    </thead>
<tbody>
    @forelse ($color_imagenes as $image)
        <tr>
            <td>
                {{ $image->color }}
            </td>
            <td>
                @if($image->imagen )
                <img src="{{ asset('images/products')}}/{{$product->id}}/{{ $image->productoColor->color->nombre }}/{{$image->imagen}}"
                    width="80px">
                @endif
            </td>
            <td style="margin: auto;text-align:center">
                @if ($image->is_default == 1)
                    <button
                        onclick="desactivar({{ $image->id }},'{{ route('producto.color-image.desactive') }}')"
                        title="desctivar" data-id="{{ $image->id }}"
                        class="btn-icon btn-icon-only btn-pill btn btn-sm btn-outline-success">
                        <i class="fa fa-check "></i>
                    </button>

                @else
                <button
                    onclick="activar({{ $image->id }},'{{ route('producto.color-image.active') }}')"
                    title="activar" data-id="{{ $image->id }}"
                    class="btn-icon btn-icon-only btn-pill btn btn-sm btn-outline-secondary">
                    <i class="fa fa-times"></i>
                 </button>
                @endif
            </td>


            <td width="150px">
                <button type="button" onclick="eliminar({{ $image->id }},'{{ route('producto.color-image.destroy', [$image->id]) }}')"
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
