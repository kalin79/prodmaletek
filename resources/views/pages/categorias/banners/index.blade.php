@extends('layouts.app')
@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div>Banners de Categoría
                <div class="page-title-subheading opacity-10">
                    <nav class="" aria-label="breadcrumb">
                        <ol class="breadcrumb">

                            <li class="breadcrumb-item">
                                <a href="{{ $breadcrumb[0]['url'] }}">{{ $breadcrumb[0]['name'] }} </a> / {{$category->name}}
                            </li>
                            <li class="active breadcrumb-item" aria-current="page">
                                {{ $breadcrumb[1]['name'] }}
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="page-title-actions">

            <div class="d-inline-block" style="background: white">
                <a href="{{ route('category.banner.create',$category->id) }}" data-id="{{$category->id}}" data-name="{{$category->name}}" class="btn btn-outline-2x btn-outline-primary entity-create ">
                    <span class="btn-icon-wrapper ">
                        <i class="fa fa-plus fa-w-20"></i>
                    </span>Agregar Banner
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
                                    <th width="200px">Banner</th>
                                    <th>Título</th>
                                    <th>Acción</th>
                                    <th width="">Orden</th>
                                    <th>Estado</th>
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
        var url_banner_load = "{{ route('category.banner.load',$category->id) }}";
        var update_order_banner = "{{ route('category.banner.update-order') }}";
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
    <!-- Bootbox modal + functions(modal, alerts Customized) -->
    <script type="text/javascript" src="{{ asset('js/bootbox.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/functions.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/filter.js') }}"></script>

    <script src="{{ asset('app/categorias/banners/index.js') }}"></script>

    <!-- Validations JS -->
    @include('scripts-group.jquery-validation')
@endpush
