<div class="row">
    <div class="col-sm">
        <div class="table-wrap">
            <div class="table-responsive">
                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th>Título</th>
                            <th>Código</th>
                            <th>Categoria</th>
                            <th>Colores</th>
                            <th class="text-center">Relacionadas</th>
                            <th>Estado </th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($productos as $producto)
                            <tr>

                                <td>{{ $producto->title_large }}</td>
                                <td>{{ $producto->code }}</td>
                                <td>{{ $producto->categoria ?$producto->categoria->name : ''  }}</td>

                                <td>
                                    <a title="Complementos" href="{{ route('producto.color.index', $producto->id) }}"
                                        class="btn btn-outline-primary btn-sm">
                                        {{ $producto->colores_count }}
                                    </a>
                                </td>
                                <td class="text-center">
                                    <a title="Relacionas"  href="{{ route('products.relacionada.index', $producto->id) }}"
                                       class="btn btn-outline-primary btn-sm">
                                        {{$producto->relation_product_count}}
                                    </a>
                                </td>
                                @if ($producto->active)
                                    <td><span class="badge badge-success">Activo</span></td>
                                @else
                                    <td><span class="badge badge-danger">No-Activo</span></td>
                                @endif
                                {{-- <td>
                                    @if ($producto->es_mas_popular == 0)
                                        <button
                                            onclick="desactivar({{ $producto->id }},'{{ route('producto.active-popular') }}')"
                                            title="activar" data-id="{{ $producto->id }}"
                                            class="btn-icon btn-icon-only btn-pill btn btn-sm btn-outline-secondary">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    @else
                                        <button
                                            onclick="activar({{ $producto->id }},'{{ route('producto.desactive-popular') }}')"
                                            title="desctivar" data-id="{{ $producto->id }}"
                                            class="btn-icon btn-icon-only btn-pill btn btn-sm btn-outline-success">
                                            <i class="fa fa-check "></i>
                                        </button>
                                    @endif
                                </td>
                                <td>
                                    @if ($producto->es_mas_visto == 0)
                                        <button
                                            onclick="desactivar({{ $producto->id }},'{{ route('producto.active-visto') }}')"
                                            title="activar" data-id="{{ $producto->id }}"
                                            class="btn-icon btn-icon-only btn-pill btn btn-sm btn-outline-secondary">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    @else
                                        <button
                                            onclick="activar({{ $producto->id }},'{{ route('producto.desactive-visto') }}')"
                                            title="desactivar" data-id="{{ $producto->id }}"
                                            class="btn-icon btn-icon-only btn-pill btn btn-sm btn-outline-success">
                                            <i class="fa fa-check "></i>
                                        </button>
                                    @endif
                                </td>--}}
                                <td>
                                    <a title="Editar" data-name="{{ $producto->title_large }}"
                                        href="{{ route('producto.edit', $producto->id) }}"
                                        class="btn btn-outline-info btn-sm ">
                                        <i class="fa fa-pen"></i>
                                    </a> &nbsp;
                                    @if ($producto->active == 1)
                                        <button
                                            onclick="desactivar({{ $producto->id }},'{{ route('producto.desactive') }}')"
                                            title="Desactivar" data-id="{{ $producto->id }}"
                                            class="btn btn-outline-warning btn-sm">
                                            <i class="fa fa-ban"></i>
                                        </button>
                                    @else
                                        <button
                                            onclick="activar({{ $producto->id }},'{{ route('producto.active') }}')"
                                            title="Activar" data-id="{{ $producto->id }}"
                                            class="btn btn-outline-success  btn-sm">
                                            <i class="fa fa-check "></i>
                                        </button>
                                    @endif
                                    <button
                                        onclick="eliminar({{ $producto->id }},'{{ route('producto.delete', $producto->id) }}')"
                                        title="Eliminar" class="btn btn-outline-danger btn-sm"
                                        data-id="{{ $producto->id }}">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted"><span>No se encontraron resultados</span>
                                </td>
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
            </div>
        </div>
    </div>
</div>
