
<div class="row">
    <div class="col-sm">
        <div class="table-wrap">
            <div class="table-responsive">
                <table class="table  table-striped mb-0">
                <thead > 
                  <tr>
                    <th>Rol</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($roles as $role)
                  <tr>
                    <td>{{ $role->name }}</td>
                    @if($role->active)
                      <td><span class="badge badge-success">Activo</span></td>
                    @else
                      <td><span class="badge badge-danger">No Activo</span></td>
                    @endif
                    <td>
                      <a title="Editar" data-name="{{$role->name}}"  href="{{ route('role.edit', $role->id) }}" class="btn btn-outline-info btn-sm edit-entity" >
                          <i class="fa fa-pencil "></i>
                      </a> &nbsp;
                      <button  onclick="eliminar({{ $role->id }},'{{route("role.destroy",$role->id )}}')" title="Eliminar" class="btn btn-outline-danger btn-sm" data-id="{{ $role->id }}">
                          <i class="fa fa-trash-o"></i>
                      </button> &nbsp;
                      @if($role->active==1)
                          <button  onclick="desactivar({{ $role->id }},'{{route("role.desactive")}}')" title="Desactivar" data-id="{{ $role->id }}" class="btn btn-outline-warning btn-sm" >
                              <i class="fa fa-ban"></i>
                          </button>
                          <a href="{{ route('access.index', $role->id ) }}" title="Permisos" class="btn btn-info btn-sm">
                            <i class="fa fa-align-justify"></i>
                          </a>
                      @else
                      
                          <button  onclick="activar({{ $role->id }},'{{route("role.active")}}')" title="Activar" data-id="{{ $role->id }}" class="btn btn-outline-success  btn-sm">
                              <i class="fa fa-check "></i>
                          </button>
                      @endif
                        
                        
                    </td>
                  </tr>
                  @endforeach
                </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="row clearfix">
  {{ $roles->links() }}
</div>