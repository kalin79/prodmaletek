
 <form action="{{ route('role.store') }}" method="POST" id="form-rol-create" class="form-horizontal">
  @csrf
  <div class="admin-form">
      <div class="row mb-20">
          <div class="col-sm">
              <div class="card" style="overflow-y: auto;max-height: 600px;">
                  <div class="card-body">
                      <div class="row">
                          <div class="form-group col-md-12">
                              <label class="form-control-label">Rol <span class="text-danger">(*)</span></label>
                              <label class="field">
                                  <div class="input-group field">
                                      <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="fa fa-tag"></i></span>
                                      </div>
                                      <input type="text" class="form-control   gui-input"  id="txt_name" name="name" type="text" >
                                  </div>
                              </label>
                               
                          </div>
                      </div>
                      
                  </div>
              </div>
          </div>
      </div>
      
  </div>
</form>