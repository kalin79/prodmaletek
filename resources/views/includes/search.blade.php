

<div class="main-card mb-3 card">
  <div class="card-body">
      
    <div class="row">
        <div class="col-md-3 text-center p1">
            <select id="cmb-field" class=" select-dropdown form-control" style="width: 100% !important">
                <option value="">Buscar por</option>
            </select>
        </div>
        <div class="col-md-2 text-center p1 content-operator" style="display: none">
            <select id="cmb-operator" class="form-control"  data-placeholder="[Operator]" style="width: 100% !important">
                <option value=""></option>
            </select>
        </div> 
        <div class="col-md-3 text-center p1 content-value" style="display: none">
            <div class="section-list">
                <select id="cmb-value" class="form-control" data-placeholder="Seleccionar" style="width: 100% !important">
                    <option value=""></option>
                </select>
            </div>
            <div class="section-text">
                <input id="text-value" type="text" placeholder="Digite aquí" class="text-center form-control">
            </div>
        </div>
        <div class="col-md-2">
            <button id='btn-add-filter' class="btn btn-outline-2x btn-outline-primary active"><span class="btn-icon-wrap"><i class="fa fa-search"></i></span></button>
        </div>
    </div>
    <div class="row pt5">
        <div class="col-md-12 text-left p1">
            <span class="fs12"><b>Filtros</b></span>
            <div id="content-filters">
                <div></div>
          </div>
        </div>
    </div>
  </div>

</div>