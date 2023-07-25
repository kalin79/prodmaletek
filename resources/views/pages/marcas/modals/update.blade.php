<div class="row row-alert" ></div>

<div class="main-card mb-3 card">
    <div class="mb-1 card  m-0 p-0">
        <div class="card-header">
            <ul class="nav nav-justified">
                <li class="nav-item">
                    <a data-toggle="tab" href="#tab-eg7-0" class="nav-link active">Información
                        básica</a>
                </li>
                <li class="nav-item">
                    <a data-toggle="tab" href="#tab-eg7-1" class="nav-link">Imagenes</a>
                </li>
            </ul>
        </div>
    </div>
    <form action="{{ route('marca.update',$marca->id) }}" method="POST" id="form-update-product"
        class="form-horizontal needs-validation">
        @csrf
        <div class="modal-body admin-form">
            <div class="card-body ">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab-eg7-0" role="tabpanel">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="position-relative form-group">
                                    <label class="field">
                                        <label for="txt_nombre" class=""><b>Marca</b></label>
                                        <input name="nombre" id="txt_nombre" placeholder="Título" type="text" class="form-control gui-input" value="{{$marca->nombre}}">
                                    </label>

                                </div>
                            </div>
                            
                            
                        </div>

                        <div class="row">
                            
                            <div class="col-md-3">
                                <div class="position-relative form-group">
                                    <label class="field">
                                        <label for="origen_pais" class=""><b>Representante</b></label>
                                        <input name="origen_pais" id="origen_pais" placeholder="Origen" type="text" class="form-control gui-input" value="{{$marca->origen_pais}}">
                                    </label>

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="position-relative form-group">
                                    <label class="field">
                                        <label for="anios_en_mercado_mundial" class=""><b>Años en el mercado mundial</b></label>
                                        <input name="anios_en_mercado_mundial" id="anios_en_mercado_mundial"  type="text" class="form-control gui-input" value="{{$marca->anios_en_mercado_mundial}}">
                                    </label>

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="position-relative form-group">
                                    <label class="field">
                                        <label for="anios_en_mercado_peru" class=""><b>Años en el mercado peruano</b></label>
                                        <input name="anios_en_mercado_peru" id="anios_en_mercado_peru"  type="text" class="form-control gui-input" value="{{$marca->anios_en_mercado_peru}}">
                                    </label>

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="position-relative form-group">
                                    <label class="field">
                                        <label for="tallares_oficiales" class=""><b>talleres oficiales </b></label>
                                        <input name="tallares_oficiales" id="tallares_oficiales"  type="text" class="form-control gui-input" value="{{$marca->tallares_oficiales}}">
                                    </label>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class=" col-md-12">
                                <label for="descripcion"><b>Descripción Principal</b></label>
                                <label class="field">
                                    <textarea id="descripcion" class="form-control form-control-sm gui-input "
                                            name="descripcion"
                                            placeholder="Descripción" >{{$marca->descripcion}}</textarea>
                                </label>
                            </div>
                           
                        </div>

                        <div class="row">
                            <div class=" col-md-6">
                                <label for="descripcion_historia_1"><b>Acerca de la marca columna 1</b></label>
                                <label class="field">
                                    <textarea id="descripcion_historia_1" class="form-control form-control-sm gui-input "
                                            name="descripcion_historia_1"
                                            placeholder="descripcion_historia_1" >{{$marca->descripcion_historia_1}}</textarea>
                                </label>
                            </div>

                            <div class=" col-md-6">
                                <label for="descripcion_historia_2"><b>Acerca de la marca columna 2</b></label>
                                <label class="field">
                                    <textarea id="descripcion_historia_2" class="form-control form-control-sm gui-input "
                                            name="descripcion_historia_2"
                                            placeholder="descripcion_historia_2" >{{$marca->descripcion_historia_2}}</textarea>
                                </label>
                            </div>
                           
                        </div>
                        
                       
                       
                    </div>
                    <div class="tab-pane" id="tab-eg7-1" role="tabpanel">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="avatar">Logo Principal</label>
                                <div class="custom-file">
                                    <input accept="image/*" class="custom-file-input" id="poster"
                                        lang="es" type="file" name="logo_principal">
                                    <label id="file-image" class="custom-file-label" for="avatar"></label>
                                </div>
                                <small>* [168 x 172] Sólo imágenes JPG y PNG, Máximo de 1M</small>
                            </div>
                            <div class="col-md-6">
                                <label for="avatar">Logo detalle</label>
                                    <div class="custom-file">
                                        <input accept="image/*" class="custom-file-input" id="poster_detalle"
                                            lang="es" type="file" name="icono_detalle">
                                        <label id="file-image-detalle" class="custom-file-label" for="avatar"></label>
                                    </div>
                                    <small>* [582 × 385] Sólo imágenes JPG y PNG, Máximo de 1M</small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="font-icon-wrapper float-left mr-3 mb-3">
                                    <img src="/images/marcas/{{$marca->id}}/{{ $marca->logo_principal }}" class="rounded-circle img-custom"
                                        id='img-upload'
                                        width="100"/>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="font-icon-wrapper float-left mr-3 mb-3 " style="background-color: gray;">
                                    <img src="/images/marcas/{{$marca->id}}/{{ $marca->logo_detalle }}" class="rounded-circle img-custom"
                                        id='img-upload-detalle'
                                        width="200"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            
                            {{-- <div class="col-sm-6">
                                
                                <label for="avatar">Imagen Detalle fondo</label>
                                <div class="custom-file">
                                    <input accept="image/*" class="custom-file-input" id="icono_promocion"
                                        lang="es" type="file" name="image_detalle">
                                    <label id="file-icon-promo" class="custom-file-label" for="avatar"></label>
                                </div>
                                <small>* [420*210] Sólo imágenes JPG y PNG, Máximo de 1M</small>
                               
                            </div> --}}
                            <div class="col-sm-6">
                                
                                <label for="avatar">Imagen Representante</label>
                                <div class="custom-file">
                                    <input accept="image/*" class="custom-file-input" id="image_pais_origen"
                                        lang="es" type="file" name="image_pais">
                                    <label id="file-icon-pais" class="custom-file-label" for="avatar"></label>
                                </div>
                                <small>* [420*210] Sólo imágenes JPG y PNG, Máximo de 1M</small>
                               
                            </div>
                            
                        </div>
                        <div class="row">
                            {{-- <div class="col-sm-6">
                                <div class="font-icon-wrapper float-left mr-3 mb-3 "  style="height: 112px">
                                    <img id="icon-promo-upload"
                                    src="/images/marcas/{{$marca->id}}/{{ $marca->image_detalle }}"
                                        class="rounded-circle img-custom"
                                        width="100" height="100px"/>
                                </div>
                            </div> --}}
                            <div class="col-sm-6">
                                <div class="font-icon-wrapper float-left mr-3 mb-3 "  style="height: 112px">
                                    <img id="icon-pais-upload"
                                    src="/images/marcas/{{$marca->id}}/{{ $marca->origen_pais_logo }}"
                                        class="rounded-circle img-custom-pais"
                                        width="100" height="100px"/>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>


<div class="row">
    <div class="col-sm-6">
        <div class="font-icon-wrapper float-left mr-3 mb-3">
            <img src="/images/marcas/{{$marca->id}}/{{ $marca->logo }}" class="rounded-circle img-custom"
                 id='img-upload'
                 width="100"/>
        </div>
    </div>
    
</div>
