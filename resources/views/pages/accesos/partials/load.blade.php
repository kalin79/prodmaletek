
<div class="row">
    <div class="col-sm">
        <div class="table-wrap">
            <div class="table-responsive">
                <table class="table table-striped  mb-0">
                    <thead>
                    <tr>
                        <th>Permiso</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($permisos as $permiso)
                        <tr >
                                <td >{{$permiso->name}}</td>
                                <td>
                                    <input type="checkbox" class="permiso_chk" @if(in_array($permiso->id,$role_permision))checked @endif data-id="{{$permiso->id}}" data-role="{{$role_id}}">
                                </td>
                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>