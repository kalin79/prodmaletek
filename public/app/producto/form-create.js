jQuery(function() {

    $('#cover').on('change', function() {
        const file = this.files[0];
        $("#file-image").text(file['name']);
        if (file) {
            let reader = new FileReader();
            reader.onload = function(event) {
                $('#img-upload').attr('src', event.target.result);
            }
            reader.readAsDataURL(file);
        }
    });

    $(".galeria").kendoUpload({
        language: "es",
        previewFileType: 'any',
        showUpload: false,
        showCaption: false,
        showRemove: false,
        autoReplace: true,
        localization: {
            select: "Seleccionar archivo...",
            remove: "Remover",
            uploadSelectedFiles: "Subir archivos"
        },
        async: {
            saveUrl: "save",
            removeUrl: "remove",
            autoUpload: false,
        },
        multiple: true,
        validation: {
            maxFileSize: 2097152,
            allowedExtensions: [".gif", ".jpg", ".png"]
        },
        select: onSelect,
    });

    $("#form-product").trigger("reset");

    tinymce.init({
        selector: '.tinymce',
        height: 200,
        plugins: [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table contextmenu paste code textcolor'
        ],
        toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | forecolor backcolor',
        setup: function(editor) {
            editor.on('change', function() {
                tinymce.triggerSave();
            });
        }
    });

    $("#cmb_categorias").select2({
        theme: "bootstrap4",
        placeholder: "Seleccione Categorias",
    })

    $("#cmb_tipo_cerradura").select2({
        theme: "bootstrap4",
        placeholder: "Seleccione",
    })

    $("#cmb_rubros").select2({
        theme: "bootstrap4",
        placeholder: "Seleccione rubros",
    })

    $("#cmb_cantidad_cajones").select2({
        theme: "bootstrap4",
        placeholder: "Seleccione",
    })

    $("#cmb_cantidad_bandeja").select2({
        theme: "bootstrap4",
        placeholder: "Seleccione rubros",
    })

    $("#cmb_tipo_cantidad_puertas").select2({
        theme: "bootstrap4",
        placeholder: "Seleccione",
    })

    $("#cmb_tipo_material").select2({
        theme: "bootstrap4",
        placeholder: "Seleccione",
    })
    $("#cmb_puerta_reforsada").select2({
        theme: "bootstrap4",
        placeholder: "Seleccione",
    })

    $("#cmb_colores").select2({
        theme: "bootstrap4",
        placeholder: "Seleccione Color",
        multiple: true
    })

    $("#cmb_cantidad_cuerpos").select2({
        theme: "bootstrap4",
        placeholder: "Seleccione",
    });
    $("#cmb_nro_cilindro").select2({
        theme: "bootstrap4",
        placeholder: "Seleccione",
    });

    $("#cmb_tipo_freno").select2({
        theme: "bootstrap4",
        placeholder: "Seleccione",
    });

    $('#pdf_ficha_tecnica').on('change', function() {
        const file = this.files[0];
        $("#file-pdf").text(file['name']);
    });


    $("#cmb_tipo_motos").select2({
        theme: "bootstrap4",
        placeholder: "Seleccione Tipo Moto",
        multiple: true
    })



    var form = $("#form-product");

    form.validate({

        /* @validation states + elements
        ------------------------------------------- */
        ignore: [],
        errorClass: "state-error",
        validClass: "state-success",
        errorElement: "em",

        /*  rules
        ------------------------------------------ */
        rules: {
            titulo: { required: true },
            titulo_descripcion: { required: true },
            marca_id: { required: true },
            precio: { required: true },
            url_video: { required: true },
            tipo_estilo_id: { required: true },

            posicion_manejo_id: { required: true },
            cilindrada: { required: true },
            potencia: { required: true },
            velocidad_maxima: { required: true },
            transmision_id: { required: true },
            numero_cambios: { required: true },

            rendimiento_por_galon: { required: true },
            sistema_combustible_id: { required: true },
            freno_delantero_disco_ventilado: { required: true },
            freno_trasero: { required: true },
            sistema_freno_abs_id: { required: true },
            neumatico_delantero: { required: true },

            neumatico_trasero: { required: true },
            peso: { required: true },
            "color_ids[]": { required: true },
            "tipo_motos_id[]": { required: true },
            nro_cilindro: { required: true },
            tipo_freno_id: { required: true },
            descripcion: { required: true },
            //ficha_pdf: { required: true },
        },

        /* @validation error messages
        ---------------------------------------------- */
        messages: {
            ficha_tecnica: {
                extension: "Por favor, selecciona un formato de archivo validado (pdf)"
            }

        },

        /* @validation highlighting + error placement
        ---------------------------------------------------- */
        highlight: function(element, errorClass, validClass) {
            $(element).closest('.field').addClass(errorClass).removeClass(validClass);
            $(element).parent().find('.select2 > .selection > .select2-selection').addClass(errorClass).removeClass(validClass);
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).closest('.field').removeClass(errorClass).addClass(validClass);
            $(element).parent().find('.select2 > .selection > .select2-selection').removeClass(errorClass).addClass(validClass);
        },
        errorPlacement: function(error, element) {
            if (element.is(":radio") || element.is(":checkbox")) {
                element.closest('.option-group').after(error);
            } else {
                error.insertAfter(element.parent());
                error.insertAfter(element.closest(".field"));
            }
        }
    });

    form.on('submit', function(e) {
        e.preventDefault();
        var fields = new FormData(this);
        if (!form.valid()) {
            $("#btn-submit-product").removeAttr("disabled");
            return false;
        }
        if (jQuery.trim(jQuery("#id_ajax").val()) == "") {
            $("#btn-submit-product").attr("disabled", true);
            jQuery("#id_ajax").val('1');
            $.ajax({
                url: $(this).attr('action'),
                type: 'post',
                data: fields,
                dataType: 'json',
                contentType: false,
                processData: false,
                beforeSend: function() {
                    showLoading('procesando...');
                },
                success: function(data) {
                    window.location.replace(data.route);
                    $("#btn-submit-product").removeAttr("disabled");
                    jQuery("#id_ajax").val("");
                },
                error: function() {
                    $("#btn-submit-product").removeAttr("disabled");
                    jQuery("#id_ajax").val("");
                }
            });
        }
    });

    if ($("#table-content-gallery").html()) {
        loadGallery();
    }
});


var load_subcategorias = function(ids) {
    $.ajax({
        url: url_list_subcategories,
        data: { parent_ids: ids },
        method: 'get',
        beforeSend: function() {
            $("#cmb_subcategoria").html('<option>Cargando datos...</option>');
        },
        success: function(data) {
            $("#cmb_subcategoria").html(data);
        }
    });
}

var imagesPreview = function(input, previewImage) {

    if (input.files) {
        var filesAmount = input.files.length;
        if (filesAmount > 2) {
            alert("The max number of files is 2");
            return false;
        }
        $(".gallery").html('');
        for (i = 0; i < filesAmount; i++) {
            var reader = new FileReader();
            var pos = 1;
            reader.onload = function(event) {
                var img = '<div class="col-sm-2" >'
                img += '<div class="font-icon-wrapper float-left mr-3 mb-3 image-preview">'
                img += '<img src="' + event.target.result + '" class="rounded-circle img-custom" width="100"/>';
                img += '</div>';
                img += '</div>';
                $(".gallery").append(img);

                pos++;
            }

            reader.readAsDataURL(input.files[i]);
        }
    }

};

function onSelect(e) {
    var fileInfos = e.files;
    var wrapper = this.wrapper;

    fileInfos.forEach(function(fileInfo) {
        setTimeout(function() {
            addPreview(fileInfo, wrapper);
        });
    });
}

function addPreview(file, wrapper) {
    var raw = file.rawFile;
    var reader = new FileReader();

    if (raw) {
        reader.onloadend = function() {
            var preview = $("<img class='image-preview' style='position: relative;vertical-align: top;height: 70px;width:70px'>").attr("src", this.result);
            wrapper.find(".k-file[data-uid='" + file.uid + "'] .k-i-jpg")
                .replaceWith(preview);
            wrapper.find(".k-upload-selected").replaceWith($(""))
        };
        reader.readAsDataURL(raw);
    }
}

function loadGallery() {
    var url = url_gallery_load;
    $.get(url, function(data) {
        $('#table-content-gallery').html(data);
        $("tbody").sortable({
            distance: 5,
            delay: 100,
            opacity: 0.6,
            cursor: 'move',
            update: function(e, ui) {
                var page_id_array = new Array();
                $('tbody tr').each(function() {
                    page_id_array.push($(this).attr('id'));
                });
                update_oder(page_id_array);
            }
        });
    });
}

var update_oder = function(page_id_array) {
    $.ajax({
        url: update_order_banner,
        method: "POST",
        data: { page_id_array: page_id_array },
        success: function() {
            loadGallery();
        }
    })
}

function eliminarImageGallery($id, $url, $token) {
    swal({
            title: "Eliminar Imagen",
            text: "Estas seguro de eliminar esta imagen",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: $url,
                    method: 'post',
                    data: {
                        id: $id,
                        _token: $token
                    },
                    beforeSend: function() {
                        showLoading('Eliminando imagen...');
                    },
                    success: function(dataJson) {
                        if (dataJson.rpt === 1) {
                            swal("Imagen eliminada correctamente", {
                                    icon: "success",
                                })
                                .then((result) => {
                                    if (result) {
                                        loadGallery();
                                    }
                                });
                        }
                    }
                });
            }
        });
}
