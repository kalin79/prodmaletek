<div class="row row-alert"></div>

<form action="{{ route('cliente.importRefinancimiento-save') }}" method="POST" id="form-import-excel"
      class="form-horizontal " enctype="multipart/form-data">
    @csrf
    <div class="modal-body admin-form">
        <div class="row">
            <div class="form-group col-sm-12">
                <label for="price_partner">Selecionar archivo:</label>
                <label class="field">
                    <input type="file" id="fileExcel" ref="fileExcel"  name="file_excel"   class="form-control">
                </label>

            </div>
        </div>
    </div>
</form>
