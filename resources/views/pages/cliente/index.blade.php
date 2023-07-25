@extends('layouts.app')
@section('content')
    <div class="app-page-title ">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div>
                    <div class="page-title-head center-elem">
                        <span class="d-inline-block pr-2">
                            <i class="fa fa-users opacity-6"></i>
                        </span>
                        <span class="d-inline-block">Socios</span>
                    </div>
                    <div class="page-title-subheading opacity-10">
                        <nav class="" aria-label="breadcrumb">
                            <ol class="breadcrumb">

                                <li class="breadcrumb-item">
                                    <a>Socios</a>
                                </li>
                                <li class="active breadcrumb-item" aria-current="page">
                                    Listado
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block" style="background: white">
                    <a href="{{route('cliente.delete-data-form')}}" data-name="" class="btn btn-outline-2x btn-outline-danger delete-data">
                        <span class="btn-icon-wrapper ">
                            <i class="fa fa-trash fa-w-20"></i>
                        </span>Eliminar Registros
                    </a>
                </div>
                <div class="d-inline-block" style="background: white">
                    <a href="{{route('cliente.importRefinancimiento')}}" class="btn btn-outline-2x btn-outline-success entity-import">
                        <span class="btn-icon-wrapper ">
                            <i class="fa fa-upload fa-w-20"></i>
                        </span>Importar
                    </a>
                </div>
                <div class="d-inline-block" style="background: white">
                    <a href="{{route('cliente.exportIngresos')}}" class="btn btn-outline-2x btn-outline-primary  ">
                        <span class="btn-icon-wrapper ">
                            <i class="fa fa-download fa-w-20"></i>
                        </span>Exportar
                    </a>
                </div>
                
            </div>
        </div>
    </div>
    @include('includes.search')
    <div class="main-card mb-3 card">
        <div class="card-body p-0">
            <div class="row">
                <div class="col-sm">
                    <div class="table-wrap">
                        <div id="table-content" class="table-responsive">
                            <table  class="table table-striped mb-0">
                                <thead>
                                <tr>
                                    <th>Socio</th>
                                    <th>DNI</th>
                                    <th>Vocativo</th>
                                    <th>Campaña</th>
                                    <th>Cumpleaños </th>
                                    <th>Tipo tarjeta </th>
                                    <th>Ingreso </th>
                                    <th>Fecha ingreso </th>
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
            <hr>
        </div>
    </div>


@endsection
@push('scripts')

  <script>
    var url_cliente_load = "{{route('client.load')}}";
    var url_filter_ingreso_load = "{{route('filter.ingreso')}}";
  </script>
  <!-- Bootbox modal + functions(modal, alerts Customized) -->
  <script type="text/javascript" src="{{ asset('js/bootbox.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/functions.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/filter.js') }}"></script>

  <script src="{{ asset( 'js/datepicker/moment.min.js' ) }}"></script>
<script src="{{ asset( 'js/datepicker/datepicker.js' ) }}"></script>
<script src="{{ asset( 'js/datepicker/daterangepicker.js' ) }}"></script>

 <!-- Select2 JavaScript -->
 <script src="{{ asset( 'template-mintos/vendors/select2/dist/js/select2.full.min.js' ) }}"></script>
 <script src="{{ asset( 'app/cliente/index.js' ) }}"></script>

 <!-- Validations JS -->
 @include('scripts-group.jquery-validation')
@endpush
