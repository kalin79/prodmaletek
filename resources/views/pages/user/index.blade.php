@extends('layouts.app')
@section('content')

    <div class="app-page-title app-page-title-simple">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div>
                    <div class="page-title-head center-elem">
                        <span class="d-inline-block pr-2">
                            <i class="fa fa-users opacity-6"></i>
                        </span>
                        <span class="d-inline-block">Usuarios</span>
                    </div>
                    <div class="page-title-subheading opacity-10">
                        <nav class="" aria-label="breadcrumb">
                            <ol class="breadcrumb">

                                <li class="breadcrumb-item">
                                    <a>Usuarios</a>
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
                    <a href="{{ route('administrator.create') }}"
                        class="btn btn-outline-2x btn-outline-primary entity-create ">
                        <span class="btn-icon-wrapper ">
                            <i class="fa fa-plus fa-w-20"></i>
                        </span>Nuevo Administrador
                    </a>
                </div>
            </div>
        </div>
    </div>
    @include('includes.search')

    <div class="main-card mb-3 card">
        <div class="card-body p-0">
            <div id="table-content">

            </div>

            <hr>
        </div>
    </div>




@endsection
@push('scripts')

    <script>
        var url_user_load = "{{ route('administrator.load') }}";

    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <!-- Bootbox modal + functions(modal, alerts Customized) -->
    <script type="text/javascript" src="{{ asset('js/bootbox.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/functions.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/filter.js') }}"></script>

    <!-- Select2 JavaScript -->


    <script src="{{ asset('app/user/index.js') }}"></script>

    <!-- Validations JS -->
    @include('scripts-group.jquery-validation')
@endpush
