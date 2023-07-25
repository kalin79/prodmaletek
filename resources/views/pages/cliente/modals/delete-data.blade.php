<div class="row row-alert"></div>

<form action="{{ route('cliente.delete-data-save') }}" method="POST" id="form-import-excel"
      class="form-horizontal " enctype="multipart/form-data">
    @csrf
    <div class="modal-body admin-form">
        <div class="row">
            <div class="form-group col-sm-12">
                <label class="form-control-label">Fecha Inicio<span class="text-danger">(*)</span></label>
                                    
                <label class="field">
                    <input type="text" id="init_date" name="init_date" class="form-control gui-input" placeholder="Fecha Inicio">
                </label>

            </div>
            <div class="form-group col-sm-12">
                <label class="form-control-label">Fecha Fin<span class="text-danger">(*)</span></label>
                                    
                <label class="field">
                    <input type="text" id="end_date" name="end_date" class="form-control gui-input" placeholder="Fecha Fin">
                </label>

            </div>
        </div>
    </div>
</form>
