<div class="row row-alert"></div>


<form action="{{ route('marca.oferta.store') }}" method="POST" id="form-create-oferta"
    class="form-horizontal needs-validation">
    @csrf
    <input type="hidden" name="marca_id" value="{{$marca->id}}">
    <div class="modal-body admin-form">
        <div class="row">
            <div class="col-md-12">
                <div class="position-relative form-group">
                    <label class="field">
                        <label for="oferta" class=""><b>Oferta</b></label>
                        <input name="oferta" id="oferta" name="oferta" placeholder="oferta" type="text"
                            class="form-control gui-input">
                    </label>

                </div>
            </div>
            
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <div class="position-relative form-group">
                    <label class="field">
                        <label for="terminos_condiciones" class=""><b>Terminos y Condiciones</b></label>
                        <textarea id="terminos_condiciones" class=" form-control"
                        name="terminos_condiciones"
                        placeholder="Ingresar Description" rows="7"></textarea>
                    </label>

                </div>
            </div>
        </div>
    </div>
</form>


