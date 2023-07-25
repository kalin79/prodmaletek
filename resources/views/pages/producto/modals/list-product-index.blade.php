@include('includes.search')
<div class="main-card mb-3 card">
    <div class="card-body p-0">
        <div class="row">
            <div class="col-sm">
                <div class="table-wrap">
                    <div id="table-content-product" class="table-responsive">
                        <table id="tbl-product" class="table table-striped mb-0">
                            <thead>
                            <tr>
                                <th >Poster</th>
                                <th>Título</th>
                                <th>Precio actual / Precio anterior</th>
                                <th width="">Stock</th>
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
