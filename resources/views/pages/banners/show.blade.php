@extends('layouts.main')

@section('content')
    @include( 'includes.breadcrumb' )
    <div id="app" class="container" style="max-width:1600px !important;">
        <div>
          <div class="row row-alert" ></div>
                <!-- Title -->
            <div class="hk-pg-header">
                <h4 class="hk-pg-title">
                    <span class="pg-title-icon">
                        <span class="feather-icon"><i data-feather="users"></i></span>
                    </span>Detalle Banner
                </h4>
            </div>
            <div class="row">
              <div class="col-xl-12">
                <section class="hk-sec-wrapper">
                  <div class="admin-form theme-primary">
                      <form method="POST"  id="form-banner" class="form-horizontal" >
                        @csrf
                      
                          <div class="section-divider mt20 mb40">
                              <span> Datos del Generales </span>
                          </div>
                            <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="control-label" for="cmb_empresa">Menú<span class="text-danger">(*)</span></label>
                                        <label class="field select">
                                            <select id="cmb_menu" name="menu_web_id" class="form-control gui-input" placeholder="Seleccione menú" disabled>
                                                <option></option>
                                                @foreach ($menus as $menu)
                                                    <option value="{{$menu->id}}" @if($menu->id==$banner->menu_web_id) selected @endif>{{$menu->nombre}}</option>
                                                @endforeach
                                            </select>
                                        </label>
                                        
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="control-label" for="cmb_empresa">Tipo<span class="text-danger">(*)</span></label>
                                        <label class="field select">
                                            <select id="cmb_tipo_banner" name="tipo_banner_id" class="form-control gui-input" placeholder="Seleccione tipo" disabled>
                                                <option></option>
                                                @foreach ($tipo_banners as $tipo)
                                                    <option value="{{$tipo->id}}" @if($tipo->id==$banner->tipo_banner_id) selected @endif>{{$tipo->nombre}}</option>
                                                @endforeach
                                            </select>
                                        </label>
                                    
                                    </div>
                                    
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="form-control-label">titulo </label>
                                    <label class="field">
                                        <input type="text" name="title" class="form-control gui-input" placeholder="titulo" value="{{$banner->title}}" readonly>
                                    </label>
                                    
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-control-label">link </label>
                                    <label class="field">
                                        <input type="text" name="link" class="form-control gui-input" placeholder="link" value="{{$banner->link}}" readonly>
                                    </label>
                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="lastName">descripción</label>
                                    <div class="tinymce-wrap">
                                        <textarea id="txt_description"  name="description" class="form-control mt-15 gui-input tinymce" placeholder="Ingresa descripción"  readonly>{{$banner->description}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                @if($banner->image)
                                <div class="col-md-6 form-group">
                                    <label for="lastName">Imagen</label>
                                    <div class="avatar-icon-wrapper mr-2 avatar-icon-xl">
                                        <div class="avatar-icon">
                                            <img class="rounded-circle img-custom" src="{{asset('images/banners')}}/{{$banner->id}}/{{$banner->image}}" alt="" title="" width="100px" height="100px">
                                        </div>
                                    </div>
                                    
                                    
                                </div>
                                @endif
                                @if($banner->icon)   
                                <div class="col-md-6 form-group">
                                    <label for="lastName">icono</label>
                                    
                                    <div class="avatar-icon-wrapper mr-2 avatar-icon-xl">
                                        <div class="avatar-icon">
                                            <img class="rounded-circle img-custom" src="{{asset('images/banners')}}/{{$banner->id}}/{{$banner->icon}}" alt="" title="" width="100px" height="100px">
                                        </div>
                                    </div>
                                    
                                </div>
                                @endif
                            </div>
                            <a href="{{route('admin.banner.index')}}"  class="btn btn-danger"  value="Cancel">Regresar</a>
                    </form>
                    
                  </div>
                </section>
              </div>
            </div>
            
        </div>
      </div>




  
@endsection

@push('scripts')
    <!-- Tinymce JavaScript -->
    <script src="{{ asset( 'template-mintos/vendors/tinymce/tinymce.min.js' ) }}"></script>

<!-- Select2 JavaScript -->
<script src="{{ asset( 'template-mintos/vendors/select2/dist/js/select2.full.min.js' ) }}"></script>
    <!-- FeatherIcons JavaScript -->
<script src="{{ asset( 'template-mintos/dist/js/feather.min.js' ) }}"></script>

 

 <script src="{{ asset( 'app/banners/show.js' ) }}"></script>

 <!-- Validations JS -->

 @include('scripts-group.jquery-validation')
@endpush

