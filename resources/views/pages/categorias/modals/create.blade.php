<div class="row row-alert"></div>

<form action="{{ route('categories.store') }}" method="POST" id="form-categoria-create"
    class="form-horizontal needs-validation">
    @csrf
    <input type="hidden" name="parent_id" value="{{$parent_id}}">
    <div class="modal-body admin-form">
        <div class="form-group">
            <label for="name">@if($parent_id==0)Categoría (*) @else Sub-Categoría (*) @endif</label>
            <label class="field">
                <input class="form-control gui-input" id="name" name="name" placeholder=""
                   required
                   type="text">
            </label>

        </div>
        <div class="form-group">
            <label for="sub_title">Subtitulo</label>
            <label class="field">
                <input class="form-control gui-input" id="sub_title" name="sub_title" placeholder=""

                       type="text">
            </label>

        </div>
        <div class="form-group">
            <label for="description">Descripción</label>
            <textarea class="form-control" name="description" id="description"></textarea>
        </div>
        @if($parent_id==0)
        <div class="form-group" >
            <label for="avatar">Poster</label>
            <div class="custom-file">
                <input accept="image/*" class="custom-file-input" id="poster"
                       lang="es" type="file" name="images">
                <label id="file-image" class="custom-file-label" for="avatar"></label>
            </div>
            <small>* [420*210] Sólo imágenes JPG y PNG, Máximo de 1M</small>
        </div>
        <div class="row" >
            <div class="col-sm-12">
                <div class="font-icon-wrapper float-left mr-3 mb-3">
                    <img src="{{}}" class="rounded-circle img-custom"
                         id='img-upload'
                         width="100"/>
                </div>
            </div>
        </div>
            <div class="form-group" >
                <label for="icon">Poster Mobile</label>
                <div class="custom-file">
                    <input accept="image/*" class="custom-file-input" id="icon"
                           lang="es" type="file" name="icon">
                    <label id="file-icono" class="custom-file-label" for="avatar"></label>
                </div>
            </div>
            <div class="row" >
                <div class="col-sm-12">
                    <div class="font-icon-wrapper float-left mr-3 mb-3">
                        <img src="" class="rounded-circle img-custom"
                             id='img-upload-icon'
                             width="100"/>
                    </div>
                </div>
            </div>
        @endif
    </div>
</form>
