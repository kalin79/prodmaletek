<div class="row row-alert" ></div>

        <form action="{{ route('producto.color.store') }}" method="POST" id="form-image-create" class="form-horizontal needs-validation">
           @csrf
          <div class="modal-body admin-form">
              <div class="form-group row">
                <label class="col-sm-3 control-label" for="roles">Colores</label>
                <div class="col-sm-9">
                  <label class="field select">
                    <select name="producto_color_id" id="cmb_colores" class="form-control  gui-input" placeholder="Seleccione un rol" style="width: 100%">
                      <option ></option>
                      @foreach($producto_colores as  $producto_color)
                        <option value="{{$producto_color->id}}" >{{$producto_color->color ? $producto_color->color->nombre : ''}}</option>
                      @endforeach
                    </select>
                  </label>
                </div>
              </div>
              
              <div class="row">
                <label class="col-sm-3 control-label" for="avatar">Imagen</label>
                <div class="col-md-9">
                   
                    <div class="custom-file">
                        <input accept="image/*" class="custom-file-input" id="poster"
                            lang="es" type="file" name="imagen">
                        <label id="file-image" class="custom-file-label" for="avatar"></label>
                    </div>
                    <small>* [168 x 172] Sólo imágenes JPG y PNG, Máximo de 1M</small>
                    <div class="font-icon-wrapper float-left mr-3 mb-3">
                        <img src="" class="rounded-circle img-custom"
                            id='img-upload'
                            width="100"/>
                    </div>
                </div>
              
            </div>
                
          </div>
        </form>
      
