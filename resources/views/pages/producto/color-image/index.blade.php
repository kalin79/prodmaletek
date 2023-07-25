@extends('layouts.app')
@section('content')
    <div class="app-page-title ">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div>
                    <div class="page-title-head center-elem">
                        <span class="d-inline-block pr-2">
                            <i class="fa lnr-store opacity-6"></i>
                        </span>
                        <span class="d-inline-block">Producto Color</span>
                    </div>
                    <div class="page-title-subheading opacity-10">
                        <nav class="" aria-label="breadcrumb">
                            <ol class="breadcrumb">

                                <li  class="breadcrumb-item">
                                    <a href="{{route('producto.index')}}">{{$product->titulo}}</a>
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
                    <a href="{{ route('producto.color.create',$product->id) }}"
                       class="btn btn-outline-2x btn-outline-primary entity-create">
                        <span class="btn-icon-wrapper ">
                            <i class="fa fa-plus fa-w-20"></i>
                        </span>Agregar Imagen
                    </a>
                </div>
            </div>

        </div>
    </div>

    <div class="main-card mb-3 card">
        <div class="card-body p-0">
            <div class="row">
                <div class="col-sm">
                    <div class="table-wrap">
                        <div id="table-content" class="table-responsive">
                            <table  class="table table-striped mb-0">
                                <thead>
                                <tr>
                                    <th>Color</th>
                                    <th>Imagen</th>
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
            <hr>
        </div>
    </div>


@endsection
@push('scripts')

  <script>
    var url_producto_color_image_load = "{{route('producto.color.load',$product->id)}}";
  </script>

    <!-- Bootbox modal + functions(modal, alerts Customized) -->
    <script type="text/javascript" src="/js/bootbox.min.js"></script>
    <script type="text/javascript" src="/js/functions.js"></script>
    <script type="text/javascript" src="/js/filter.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script src="{{ asset( 'app/producto/index-color-image.js' ) }}"></script>

 <!-- Validations JS -->
 @include('scripts-group.jquery-validation')
 <style>
    td:hover{
        cursor:move;
    }
</style>
@endpush
