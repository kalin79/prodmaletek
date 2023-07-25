@extends('layouts.app')
@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-graph text-success"></i>
                </div>
                <div>Registro de Producto
                    <div class="page-title-subheading opacity-10">
                        <nav class="" aria-label="breadcrumb">
                            <ol class="breadcrumb">

                                <li class="breadcrumb-item">
                                    <a>Producto</a>
                                </li>
                                <li class="active breadcrumb-item" aria-current="page">
                                    Registro
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="tab-content">
        <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
            <div class="main-card mb-3 card">
                <div class="mb-1 card  m-0 p-0">
                    <div class="card-header">
                        <ul class="nav nav-justified">
                            <li class="nav-item">
                                <a data-toggle="tab" href="#tab-eg7-0" class="nav-link active">Información
                                    básica</a>
                            </li>
                            <li class="nav-item">
                                <a data-toggle="tab" href="#tab-eg7-1" class="nav-link">Imágenes</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="admin-form theme-primary">
                    <form method="POST" action="{{ route('producto.update',$product->id) }}" id="form-product" class="form-horizontal"
                          enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="id_ajax" value="">

                        <div class="card-body ">
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab-eg7-0" role="tabpanel">

                                    <div class="form-row">
                                        <div class="col-md-3">
                                            <div class="position-relative form-group">
                                                <label class="field">
                                                    <label for="title_large" class=""><b>Producto</b></label>
                                                    <input name="title_large" id="title_large" placeholder="Título" type="text" class="form-control gui-input" value="{{$product->title_large}}">
                                                </label>

                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="position-relative form-group">
                                                <label class="field">
                                                    <label for="code" class=""><b>Código</b></label>
                                                    <input name="code" id="code" placeholder="Código" type="text" class="form-control gui-input" value="{{$product->code}}">
                                                </label>

                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group overflow-auto vh-75 ">
                                                <label for="cmb_categorias"><b>Categorias</b></label>
                                                <label class="field select">
                                                    <select id="cmb_categorias" name="categoria_id" class=" form-control " placeholder="Seleccione marca" style="width: 100% !important">
                                                        <option></option>
                                                        @foreach ($categorias as $categoria)
                                                            <option value="{{$categoria->id}}" @if($categoria->id==$product->categoria_id) selected @endif>{{$categoria->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group overflow-auto vh-75 ">
                                                <label for="cmb_rubros"><b>Rubro</b></label>
                                                <label class="field select">
                                                    <select id="cmb_rubros" name="rubro_id" class=" form-control " placeholder="Seleccione rubro" style="width: 100% !important">
                                                        <option></option>
                                                        @foreach ($rubros as $rubro)
                                                            <option value="{{$rubro->id}}" @if($rubro->id==$product->rubro_id) selected @endif>{{$rubro->nombre}}</option>
                                                        @endforeach
                                                    </select>
                                                </label>
                                            </div>
                                        </div>



                                    </div>

                                    <div class="row">

                                        <div class="col-md-3">
                                            <div class="position-relative form-group">
                                                <label class="field">
                                                    <label for="ancho" class=""><b>Ancho</b></label>
                                                    <input name="ancho" id="ancho" placeholder="Ancho" type="text" class="form-control gui-input " value="{{$product->ancho}}">
                                                </label>

                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="position-relative form-group">
                                                <label class="field">
                                                    <label for="alto" class=""><b>Alto</b></label>
                                                    <input name="alto" id="alto" placeholder="Alto" type="text" class="form-control gui-input " value="{{$product->alto}}">
                                                </label>

                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="position-relative form-group">
                                                <label class="field">
                                                    <label for="fondo" class=""><b>Fondo</b></label>
                                                    <input name="fondo" id="fondo" placeholder="Fondo" type="text" class="form-control gui-input " value="{{$product->fondo}}">
                                                </label>

                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group overflow-auto vh-75 ">
                                                <label for="title_large"><b>Cantidad de Puertas</b></label>
                                                <label class="field select">
                                                    <select id="cmb_tipo_cantidad_puertas" name="tipo_cantidad_puertas_id" class=" form-control " placeholder="Seleccione" style="width: 100% !important">
                                                        <option></option>
                                                        @foreach ($tipos_cantidad_puertas as $cantidad_puertas)
                                                            <option value="{{$cantidad_puertas->id}}" @if($cantidad_puertas->id==$product->tipo_cantidad_puertas_id) selected @endif>{{$cantidad_puertas->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="position-relative form-group">
                                                <label class="field">
                                                    <label for="alto_puerta" class=""><b>Alto Puerta</b></label>
                                                    <input name="alto_puerta" id="alto_puerta" placeholder="Alto Puerta" type="text" class="form-control gui-input " value="{{$product->alto_puerta}}">
                                                </label>

                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="position-relative form-group">
                                                <label class="field">
                                                    <label for="ancho_puerta" class=""><b>Ancho de puerta</b></label>
                                                    <input name="ancho_puerta" id="ancho_puerta" placeholder="Ancho de puerta" type="text" class="form-control gui-input" value="{{$product->ancho_puerta}}">
                                                </label>

                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group overflow-auto vh-75 ">
                                                <label for="title_large"><b>Tipo de material</b></label>
                                                <label class="field select">
                                                    <select id="cmb_tipo_material" name="tipo_material_id" class=" form-control " placeholder="Seleccione Tipo Material" style="width: 100% !important">
                                                        <option></option>
                                                        @foreach ($tipos_material as $material)
                                                            <option value="{{$material->id}}" @if($material->id==$product->tipo_material_id) selected @endif>{{$material->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-3">
                                            <label for="pintura"><b>Pintura</b></label>
                                            <label class="field">
                                                    <textarea id="pintura" class="form-control form-control-sm gui-input"
                                                              name="pintura"
                                                              placeholder="Pintura" >{{$product->pintura}}</textarea>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="puerta_reforsada"><b>Puertas reforzadas</b></label>
                                            <label class="field select">
                                                <select id="sistema_freno_abs_id" name="puerta_reforsada" class=" form-control " placeholder="Seleccione" style="width: 100% !important">
                                                    <option></option>
                                                    <option value="1" @if($product->puerta_reforsada==1) selected @endif>SI</option>
                                                    <option value="0" @if($product->puerta_reforsada==0) selected @endif>NO</option>
                                                </select>
                                            </label>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group overflow-auto vh-75 ">
                                                <label for="cmb_tipo_cerradura"><b>Tipo cerradura</b></label>
                                                <label class="field select">
                                                    <select id="cmb_tipo_cerradura" name="tipo_cerradura" class=" form-control " placeholder="Seleccione" style="width: 100% !important">
                                                        <option></option>
                                                        @foreach ($tipos_cerradura as $tipo_cerradura)
                                                            <option value="{{$tipo_cerradura->id}}" @if($tipo_cerradura->id== $product->tipo_cerradura) selected @endif>{{$tipo_cerradura->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group overflow-auto vh-75 ">
                                                <label for="title_large"><b>Cantida de Cuerpos</b></label>
                                                <label class="field select">
                                                    <select id="cmb_cantidad_cuerpos" name="tipo_cantidad_cuerpos_id" class=" form-control " placeholder="Seleccione" style="width: 100% !important">
                                                        <option></option>
                                                        @foreach ($tipos_cantidad_cuerpos as $cantidad_cuerpos)
                                                            <option value="{{$cantidad_cuerpos->id}}" @if($cantidad_cuerpos->id== $product->tipo_cantidad_cuerpos_id) selected @endif>{{$cantidad_cuerpos->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-3">
                                            <label for="bisagra"><b>Bisagras</b></label>
                                            <label class="field">
                                                    <textarea id="bisagra" class="form-control form-control-sm gui-input"
                                                              name="bisagras"
                                                              placeholder="Bisagras" >{{$product->bisagras}}</textarea>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group overflow-auto vh-75 ">
                                                <label for="cmb_cantidad_cajones"><b>Cantida de Cajones</b></label>
                                                <label class="field select">
                                                    <select id="cmb_cantidad_cajones" name="tipo_cantidad_cajones_id" class=" form-control " placeholder="Seleccione" style="width: 100% !important">
                                                        <option></option>
                                                        @foreach ($tipos_cantidad_cajones as $tipo_cantidad_cajones)
                                                            <option value="{{$tipo_cantidad_cajones->id}}" @if($tipo_cantidad_cajones->id== $product->tipo_cantidad_cajones_id) selected @endif>{{$tipo_cantidad_cajones->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group overflow-auto vh-75 ">
                                                <label for="cmb_cantidad_bandeja"><b>Cantida de Bandejas</b></label>
                                                <label class="field select">
                                                    <select id="cmb_cantidad_bandeja" name="tipo_cantidad_bandejas_id" class=" form-control " placeholder="Seleccione" style="width: 100% !important">
                                                        <option></option>
                                                        @foreach ($tipos_cantidad_bandejas as $tipo_cantidad_bandeja)
                                                            <option value="{{$tipo_cantidad_bandeja->id}}" @if($tipo_cantidad_bandeja->id== $product->tipo_cantidad_bandejas_id) selected @endif>{{$tipo_cantidad_bandeja->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group overflow-auto vh-75 ">
                                                <label for="cmb_colores"><b>Color</b></label>
                                                <label class="field select">
                                                    <select id="cmb_colores" name="color_ids[]" multiple="" class=" form-control " placeholder="Seleccione colres" style="width: 100% !important">
                                                        <option></option>
                                                        @foreach ($colores as $color)
                                                            <option value="{{$color->id}}" @if(in_array($color->id,$colores_producto)) selected @endif>{{$color->nombre}}</option>
                                                        @endforeach
                                                    </select>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="form-group col-sm-3">
                                            <label for="accesorios"><b>Accesorios</b></label>
                                            <label class="field">
                                                    <textarea id="accesorios" class="form-control form-control-sm gui-input"
                                                              name="accesorios"
                                                              placeholder="Accesorios" >{{$product->accesorios}}</textarea>
                                            </label>
                                        </div>

                                        <div class="form-group col-sm-3">
                                            <label for="ventilacion"><b>Ventilación</b></label>
                                            <label class="field">
                                                    <textarea id="ventilacion" class="form-control form-control-sm gui-input"
                                                              name="ventilacion"
                                                              placeholder="Ventilación" >{{$product->ventilacion}}</textarea>
                                            </label>
                                        </div>
                                        <div class="form-group col-sm-3">
                                            <label for="garantia"><b>Garantia</b></label>
                                            <label class="field">
                                                    <textarea id="garantia" class="form-control form-control-sm gui-input"
                                                              name="garantia"
                                                              placeholder="Garantia" >{{$product->garantia}}</textarea>
                                            </label>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            <label for="description"><b>Descripción</b></label>
                                            <label class="field">
                                                    <textarea id="description" class="form-control form-control-sm gui-input tinymce"
                                                              name="description"
                                                              placeholder="Descripción" rows="10">{{$product->description}}</textarea>
                                            </label>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="conditions"><b>Usos</b></label>
                                            <label class="field">
                                                    <textarea id="conditions" class="form-control form-control-sm gui-input tinymce"
                                                              name="conditions"
                                                              placeholder="Usos" rows="10">{{$product->conditions}}</textarea>
                                            </label>
                                        </div>


                                    </div>
                                    <div class="row">

                                        <div class="form-group col-sm-6">
                                            <label for="archivo">Ficha Técnica</label>
                                            <div class="custom-file">
                                                <label class="field">
                                                    <input accept="application/pdf" class="custom-file-input" id="pdf_ficha_tecnica"
                                                        lang="es" type="file" name="ficha_pdf">
                                                </label>
                                                <label id="file-pdf" class="custom-file-label" for="archivo"></label>
                                            </div>
                                            @if($product->ficha_tecnica)
                                                <a href="{{route('products.showFile',$product->id)}}" target="_blanck">ver archivo</a>
                                            @endif
                                        </div>

                                        <div class="form-group col-sm-6">
                                            <label for="archivo">Imagen cover</label>
                                            <div class="custom-file">
                                                <input accept="image/*" class="custom-file-input" id="cover"
                                                       lang="es" type="file" name="imagen_cover">
                                                <label id="file-image" class="custom-file-label" for="avatar"></label>
                                            </div>
                                            <small>* [168 x 172] Sólo imágenes JPG y PNG, Máximo de 1M</small>
                                            <div class="font-icon-wrapper float-left mr-3 mb-3">
                                                <img src="{{ asset('images/products') }}/{{ $product->id }}/{{ $product->image_cover }}" class="rounded-circle img-custom"
                                                     id='img-upload'
                                                     width="100"/>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                                <div class="tab-pane" id="tab-eg7-1" role="tabpanel">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <p>Galería de Imágenes</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <input type="file" accept="image/*" class="galeria"
                                                            id="galeria" name="gallery[]" lang="es" multiple = "multiple" >
                                                <small>* [1000*1000] Sólo imágenes JPG y PNG, Máximo de 1M</small>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-sm">
                                            <div class="table-wrap">
                                                <div id="table-content-gallery" class="table-responsive">
                                                    <table  class="table table-striped mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th>Imagen</th>
                                                                <th>Orden</th>
                                                                <th>Opciones</th>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                    <div id="loading" class="text-center">
                                                        <i class="fa fa-spinner fa-pulse fa-lg p-5" role="status" aria-hidden="true"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="d-block text-right card-footer">
                            <a href="{{route('producto.index')}}" class="btn-wide   btn btn-secondary ">Cancelar</a>
                            <button type="submit" id="btn-submit-product" class="btn-wide  btn btn-primary">Guardar
                            </button>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </div>
@endsection
@push('scripts')

    <script>

        var url_gallery_load        = "{{ route('products.gallery.load',$product->id) }}";
        var update_order_banner     =  "{{ route('products.gallery.update-order') }}";
    </script>
    <script src="{{ asset( 'template-mintos/vendors/tinymce/tinymce.min.js' ) }}"></script>
     <script src="{{ asset('architec-ui/js/vendors/form-components/bootstrap-multiselect.js') }}"></script>
    <script type="text/javascript" src="{{ asset('kendo/js/kendo.all.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('kendo/js/kendo.culture.es-ES.min.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script src="{{ asset('app/producto/form-create.js') }}"></script>

    <!-- Validations JS -->
    @include('scripts-group.jquery-validation')
@endpush
