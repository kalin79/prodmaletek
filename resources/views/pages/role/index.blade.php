@extends('layouts.main')
@section('content')
@include( 'includes.breadcrumb' )

<div id="app" class="container" style="max-width:1600px !important;">
  <div>
          <!-- Title -->
      <div class="hk-pg-header">
          <h4 class="hk-pg-title">
              <span class="pg-title-icon">
                  <span class="feather-icon"><i data-feather="archive"></i></span>
              </span>Roles
          </h4>
          <div class="d-flex " style="background: white">
            <a href="{{route('role.create')}}" class="btn btn-outline-primary btn entity-create ">
              <span class="btn-icon-wrapper opacity-7">
                  <i class="fa fa-plus fa-w-20"></i>
              </span>Nuevo Rol
            </a>
          </div>
      </div>
      <!-- /Title -->
      
      @include('includes.search')
      <div class="row">
        <div class="col-xl-12">
          <section class="hk-sec-wrapper">
            <div id="table-content">
                        
            </div>
              
          </section>
        </div>
      </div>
      
  </div>
</div>

@endsection

@push('scripts')
  <script>
      var url_role_load = "{{route('role.load')}}";
  </script>
<!-- Bootbox modal + functions(modal, alerts Customized) -->
<script type="text/javascript" src="{{ asset('js/bootbox.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/functions.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/filter.js') }}"></script>

 <script src="{{ asset( 'template-mintos/vendors/select2/dist/js/select2.full.min.js' ) }}"></script>
<script src="{{ asset( 'app/role/index.js' ) }}"></script>


 <!-- Validations JS -->
 @include('scripts-group.jquery-validation')
@endpush