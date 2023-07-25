@extends('layouts.app')
@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-graph text-success"></i>
                </div>
                <div>Ofertas
                    <div class="page-title-subheading opacity-10">
                        <nav class="" aria-label="breadcrumb">
                            <ol class="breadcrumb">

                                <li class="breadcrumb-item">
                                    <a href="{{route('marca.index')}}">Marcas</a>
                                </li>
                                <li class="active breadcrumb-item" aria-current="page">
                                    Ofertas
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="page-title-actions">

                <div class="d-inline-block" style="background: white">
                    <a href="{{ route('marca.oferta.create',$marca->id) }}" data-id="{{$marca->id}}" data-name="{{$marca->marca}}" class="btn btn-outline-2x btn-outline-primary entity-create ">
                        <span class="btn-icon-wrapper ">
                            <i class="fa fa-plus fa-w-20"></i>
                        </span>Agregar Oferta
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-content">
        <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
            <div class="main-card mb-3 card">
                <div class="admin-form theme-primary">
                    <div class="card-body ">
                        <form action="#"  class="form-horizontal">
                            <input type="hidden" id="producto_id" value="{{$marca->id}}" >
                            @csrf

                            <div class="section-divider mt20 mb40">
                                <span> Datos del producto </span>
                            </div>
                            <div class="row">

                                <div class="form-group col-md-6">
                                    <label class="control-label" for="roles">Marca</label>
                                    <label class="field">

                                        <input type="text" class="form-control gui-input" value="{{$marca->marca}}"   type="text"  readonly>

                                    </label>

                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="roles">Tipo</label>
                                    <label class="field">

                                        <input type="text" class="form-control gui-input" value=""   type="text"  readonly>

                                    </label>

                                </div>
                                
                            </div>


                        </form>
                        <div class="section-divider mt20 mb40">
                            <span> Listado de ofertas </span>
                        </div>
                        <div id="table-content-ofertas">

                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
@endsection
@push('scripts')

    <script>
        var url_ofertas_load = "{{route('marca.oferta.load',$marca->id)}}";
       
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <!-- Bootbox modal + functions(modal, alerts Customized) -->
    <script type="text/javascript" src="{{ asset('js/bootbox.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/functions.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/filter.js') }}"></script>

    <script src="{{ asset('app/marca/index-oferta.js') }}"></script>

    <!-- Validations JS -->
    @include('scripts-group.jquery-validation')
@endpush
