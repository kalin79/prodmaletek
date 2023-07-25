
<div class="row">
    <div class="col-sm">
        <div class="table-wrap">
            <div class="table-responsive">
                <table class="table table-striped mb-0">
                    <thead >
                    <tr>
                        <th>nombre</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @foreach ($user->role as $role)
                            <span class="badge badge-alternate active mr-2" >
                                {{ $role->title }}
                            </span>
                            @endforeach
                        </td>
                        @if($user->active)
                        <td><span class="badge badge-success">Activo</span></td>
                        @else
                        <td><span class="badge badge-danger">No-Activo</span></td>
                        @endif
                        <td>

                                <a title="Editar" data-name="{{$user->title}}"  href="{{ route('administrator.edit', $user->id) }}" class="btn btn-outline-info btn-sm edit-entity" >
                                    <i class="fa fa-pen"></i>
                                </a> &nbsp;

                                <button  onclick="eliminar({{ $user->id }},'{{route("administrator.delete")}}')" title="Eliminar" class="btn btn-outline-danger btn-sm" data-id="{{ $user->id }}">
                                    <i class="fa fa-trash"></i>
                                </button> &nbsp;

                                @if($user->active==1)
                                    <button  onclick="desactivar({{ $user->id }},'{{route("administrator.desactive")}}')" title="Desactivar" data-id="{{ $user->id }}" class="btn btn-outline-warning btn-sm" >
                                        <i class="fa fa-ban"></i>
                                    </button>
                                @else

                                    <button  onclick="activar({{ $user->id }},'{{route("administrator.active")}}')" title="Activar" data-id="{{ $user->id }}" class="btn btn-outline-success  btn-sm">
                                        <i class="fa fa-check"></i>
                                    </button>
                                @endif

                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr >
                            <td colspan="4">{{ $users->links() }}</td>
                            <td><span>Total: </span> <b>{{ $users->total() }}</b></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
