<div class="row row-alert"></div>


<form action="{{ route('marca.oferta.update',$oferta->id) }}" method="POST" id="form-edit-oferta"
    class="form-horizontal needs-validation">
    @csrf
    <div class="modal-body admin-form">
        <div class="row">
            <div class="col-md-12">
                <div class="position-relative form-group">
                    <label class="field">
                        <label for="oferta" class=""><b>Oferta</b></label>
                        <input name="oferta" id="oferta" name="oferta" placeholder="oferta" type="text"
                            class="form-control gui-input" value="{{$oferta->oferta}}">
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
                        placeholder="Ingresar Description" rows="7">{{$oferta->terminos_condiciones}}</textarea>
                    </label>

                </div>
            </div>
        </div>
    </div>
</form>

