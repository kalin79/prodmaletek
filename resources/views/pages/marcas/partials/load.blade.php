
<div class="row">
    <div class="col-sm">
        <div class="table-wrap">
            <div class="table-responsive">
                <table class="table table-striped mb-0">
                    <thead >
                        <tr>
                            <th>Logo</th>
                            <th>Marca</th>
                            <th>Origen</th>
                            <th >AÑOS EN EL MERCADO
                                MUNDIAL</th>
                            <th>AÑOS EN EL MERCADO
                                Peruano</th>
                            <th >talleres oficiales</th>
                            <th>Estado </th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse ($marcas as $marca)
                        <tr>
                            <td>
                                @if($marca->logo_principal )
                                <img src="/images/marcas/{{$marca->id}}/{{ $marca->logo_principal }}" 
                                    width="80px">
                                @endif
                            </td>
                            <td>{{ $marca->nombre }}</td>
                            <td>{{ $marca->origen_pais }}</td>
                            <td >
                                {{ $marca->anios_en_mercado_mundial }}
                            </td>
                            <td>{{$marca->anios_en_mercado_peru}}</td>
                            <td >{{$marca->tallares_oficiales}}</td>
                            @if($marca->active)
                            <td><span class="badge badge-success">Activo</span></td>
                            @else
                            <td><span class="badge badge-danger">No-Activo</span></td>
                            @endif

                            <td >
                                <a title="Editar" data-name="{{$marca->nombre}}"  href="{{ route('marca.edit', $marca->id) }}" class="btn btn-outline-info btn-sm edit-entity" >
                                    <i class="fa fa-pen"></i>
                                </a> &nbsp;
                                @if($marca->active==1)
                                    <button  onclick="desactivar({{ $marca->id }},'{{route("marca.desactive")}}')" title="Desactivar" data-id="{{ $marca->id }}" class="btn btn-outline-warning btn-sm" >
                                        <i class="fa fa-ban"></i>
                                    </button>
                                @else

                                    <button  onclick="activar({{ $marca->id }},'{{route("marca.active")}}')" title="Activar" data-id="{{ $marca->id }}" class="btn btn-outline-success  btn-sm">
                                        <i class="fa fa-check "></i>
                                    </button>
                                @endif

                                <button  onclick="eliminar({{ $marca->id }},'{{route("marca.delete",$marca->id)}}')" title="Eliminar" class="btn btn-outline-danger btn-sm" data-id="{{ $marca->id }}">
                                    <i class="fa fa-trash"></i>
                                </button> &nbsp;
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted"><span>No se encontraron resultados</span></td>
                        </tr>
                    @endforelse

                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="7">{{ $marcas->links() }}</td>
                            <td><span>Total: </span> <b>{{ $marcas->total() }}</b></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
