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
              </span>Permisos
          </h4>
          
      </div>
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
    var url_permisos_load = "{{route('access.load',$id_role)}}";
  </script>
  <!-- Bootbox modal + functions(modal, alerts Customized) -->
  <script type="text/javascript" src="{{ asset('js/bootbox.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/functions.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/filter.js') }}"></script>

 <!-- Select2 JavaScript -->
 <script src="{{ asset( 'template-mintos/vendors/select2/dist/js/select2.full.min.js' ) }}"></script>
 


 <script src="{{ asset( 'app/permisos/index.js' ) }}"></script>

 <!-- Validations JS -->
 @include('scripts-group.jquery-validation')
@endpush