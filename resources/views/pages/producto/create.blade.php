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
                        <form method="POST" action="{{ route('producto.store') }}" id="form-product" class="form-horizontal" enctype="multipart/form-data">
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
                                                        <input name="title_large" id="title_large" placeholder="Título" type="text" class="form-control gui-input">
                                                    </label>

                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="position-relative form-group">
                                                    <label class="field">
                                                        <label for="code" class=""><b>Código</b></label>
                                                        <input name="code" id="code" placeholder="Código" type="text" class="form-control gui-input">
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
                                                                <option value="{{$categoria->id}}">{{$categoria->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group overflow-auto vh-75 ">
                                                    <label for="cmb_rubros"><b>Rubro</b></label>
                                                    <label class="field select">
                                                        <select id="cmb_rubros" name="rubro_id" class=" form-control " placeholder="Seleccione marca" style="width: 100% !important">
                                                            <option></option>
                                                            @foreach ($rubros as $rubro)
                                                                <option value="{{$rubro->id}}">{{$rubro->nombre}}</option>
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
                                                        <input name="ancho" id="ancho" placeholder="Ancho" type="text" class="form-control gui-input ">
                                                    </label>

                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="position-relative form-group">
                                                    <label class="field">
                                                        <label for="alto" class=""><b>Alto</b></label>
                                                        <input name="alto" id="alto" placeholder="Alto" type="text" class="form-control gui-input ">
                                                    </label>

                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="position-relative form-group">
                                                    <label class="field">
                                                        <label for="fondo" class=""><b>Fondo</b></label>
                                                        <input name="fondo" id="fondo" placeholder="Fondo" type="text" class="form-control gui-input ">
                                                    </label>

                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group overflow-auto vh-75 ">
                                                    <label for="cmb_tipo_cantidad_puertas"><b>Cantidad de Puertas</b></label>
                                                    <label class="field select">
                                                        <select id="cmb_tipo_cantidad_puertas" name="tipo_cantidad_puertas_id" class=" form-control " placeholder="Seleccione" style="width: 100% !important">
                                                            <option></option>
                                                            @foreach ($tipos_cantidad_puertas as $cantidad_puertas)
                                                                <option value="{{$cantidad_puertas->id}}">{{$cantidad_puertas->name}}</option>
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
                                                        <input name="alto_puerta" id="alto_puerta" placeholder="Alto Puerta" type="text" class="form-control gui-input ">
                                                    </label>

                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="position-relative form-group">
                                                    <label class="field">
                                                        <label for="ancho_puerta" class=""><b>Ancho de puerta</b></label>
                                                        <input name="ancho_puerta" id="ancho_puerta" placeholder="Ancho de puerta" type="text" class="form-control gui-input">
                                                    </label>

                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group overflow-auto vh-75 ">
                                                    <label for="cmb_tipo_material"><b>Tipo de material</b></label>
                                                    <label class="field select">
                                                        <select id="cmb_tipo_material" name="tipo_material_id" class=" form-control " placeholder="Seleccione Tipo Material" style="width: 100% !important">
                                                            <option></option>
                                                            @foreach ($tipos_material as $material)
                                                                <option value="{{$material->id}}">{{$material->name}}</option>
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
                                                              placeholder="Pintura" ></textarea>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-3">
                                                <label for="cmb_puerta_reforsada"><b>Puertas reforzadas</b></label>
                                                <label class="field select">
                                                    <select id="cmb_puerta_reforsada" name="puerta_reforsada" class=" form-control " placeholder="Seleccione" style="width: 100% !important">
                                                        <option></option>
                                                        <option value="1">SI</option>
                                                        <option value="0">NO</option>
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
                                                                <option value="{{$tipo_cerradura->id}}">{{$tipo_cerradura->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </label>
                                                </div>
                                            </div>


                                            <div class="col-md-3">
                                                <div class="form-group overflow-auto vh-75 ">
                                                    <label for="cmb_cantidad_cuerpos"><b>Cantida de Cuerpos</b></label>
                                                    <label class="field select">
                                                        <select id="cmb_cantidad_cuerpos" name="tipo_cantidad_cuerpos_id" class=" form-control " placeholder="Seleccione" style="width: 100% !important">
                                                            <option></option>
                                                            @foreach ($tipos_cantidad_cuerpos as $cantidad_cuerpos)
                                                                <option value="{{$cantidad_cuerpos->id}}">{{$cantidad_cuerpos->name}}</option>
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
                                                              placeholder="Bisagras" ></textarea>
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
                                                                <option value="{{$tipo_cantidad_cajones->id}}" >{{$tipo_cantidad_cajones->name}}</option>
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
                                                                <option value="{{$tipo_cantidad_bandeja->id}}" >{{$tipo_cantidad_bandeja->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group overflow-auto vh-75 ">
                                                    <label for="cmb_colores"><b>Color</b></label>
                                                    <label class="field select">
                                                        <select id="cmb_colores" name="color_ids[]" multiple="" class=" form-control " placeholder="Seleccione Sistema de Combustible" style="width: 100% !important">
                                                            <option></option>
                                                            @foreach ($colores as $color)
                                                                <option value="{{$color->id}}">{{$color->nombre}}</option>
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
                                                              placeholder="Accesorios" ></textarea>
                                                </label>
                                            </div>

                                            <div class="form-group col-sm-3">
                                                <label for="ventilacion"><b>Ventilación</b></label>
                                                <label class="field">
                                                    <textarea id="ventilacion" class="form-control form-control-sm gui-input"
                                                              name="ventilacion"
                                                              placeholder="Ventilación" ></textarea>
                                                </label>
                                            </div>
                                            <div class="form-group col-sm-3">
                                                <label for="garantia"><b>Garantia</b></label>
                                                <label class="field">
                                                    <textarea id="garantia" class="form-control form-control-sm gui-input"
                                                              name="garantia"
                                                              placeholder="Garantia" ></textarea>
                                                </label>
                                            </div>

                                        </div>



                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                <label for="description"><b>Descripción</b></label>
                                                <label class="field">
                                                    <textarea id="description" class="form-control form-control-sm gui-input tinymce"
                                                            name="description"
                                                            placeholder="Descripción" rows="10"></textarea>
                                                </label>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="conditions"><b>Usos</b></label>
                                                <label class="field">
                                                    <textarea id="conditions" class="form-control form-control-sm gui-input tinymce"
                                                              name="conditions"
                                                              placeholder="Usos" rows="10"></textarea>
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
                                                    <img src="" class="rounded-circle img-custom"
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
                                    </div>
                                </div>
                            </div>
                            <div class="d-block text-right card-footer">
                                <a href="{{route('producto.index')}}" class="btn-wide   btn btn-secondary ">Cancelar</a>
                                <button type="submit" id="btn-submit-product" class="btn-wide  btn btn-primary">Guardar</button>
                            </div>
                        </form>
                    </div>

            </div>

        </div>
    </div>
@endsection
@push('scripts')

    <script>
    </script>
    <script src="{{ asset( 'template-mintos/vendors/tinymce/tinymce.min.js' ) }}"></script>
    <script src="{{ asset('architec-ui/js/vendors/form-components/bootstrap-multiselect.js') }}"></script>
    <script type="text/javascript" src="{{ asset('kendo/js/kendo.all.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('kendo/js/kendo.culture.es-ES.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <!-- Bootbox modal + functions(modal, alerts Customized) -->
    <script type="text/javascript" src="{{ asset('js/bootbox.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/functions.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/filter.js') }}"></script>
    <script src="{{ asset('app/producto/form-create.js') }}"></script>

    <!-- Validations JS -->
    @include('scripts-group.jquery-validation')
@endpush
