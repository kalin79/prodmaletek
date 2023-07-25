jQuery(function() {

    $(document).on('focusin', function(e) {
        if ($(e.target).closest(".mce-window").length) {
            e.stopImmediatePropagation();
        }
    });
    load();
    var data_fields = [
        { "id": 1, "text": "marca", type: 'text', field: 'nombre' },
    ];
    $("#cmb-field").select2({
        theme: "bootstrap4",
        "data": data_fields,
        placeholder: "Buscar por "
    });

    CI.filter({
        controls: { field: '#cmb-field', operator: '#cmb-operator', value: '#text-value' },
        data: data_fields,
        default_filter: 'byField',
        elemnt_action: '#btn-add-filter',
        text_value: '#text-value',
        content_filters: '#content-filters',

        load: function() {
            load();
        }
    });

    var customize_rules = {

        /* @validation states + elements
        ------------------------------------------- */
        ignore: [],
        errorClass: "state-error",
        validClass: "state-success",
        errorElement: "em",

        /*  rules
        ------------------------------------------ */
        rules: {

        },

        /* @validation error messages
        ---------------------------------------------- */
        messages: {},

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
    };

    var rules = $.extend(true, {}, customize_rules);
    rules.rules = {
        nombre: { required: true },
        origen_pais: { required: true },
        anios_en_mercado_mundial: { required: true },
        anios_en_mercado_peru: { required: true },
        tallares_oficiales: { required: true },
        descripcion: { required: true },
        logo_principal: { required: true },
        icono_detalle: { required: true },
        image_detalle: { required: true },
        image_pais: { required: true },

    }

    ModalCRUD.create({
        title: 'Marca',
        mode: 'lg',
        element: '.entity-create',
        form_element: '#form-create-product',
        element_is_load: true,
        isLoadFromAjax: false,
        rules: rules,
        url: function(elemt) {
            return $(elemt).attr('href');
        },
        initialized: function() {
            $(".modal-title").text('Nueva Marca');
            $("#cmb_categoria").select2({
                theme: "bootstrap4",
                placeholder: "Seleccione categoria",
                dropdownParent: $('.bootbox'),
                allowClear: true,
            });
            $('#poster').on('change', function() {
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

            $('#poster_detalle').on('change', function() {
                const file = this.files[0];
                $("#file-image-detalle").text(file['name']);
                if (file) {
                    let reader = new FileReader();
                    reader.onload = function(event) {
                        $('#img-upload-detalle').attr('src', event.target.result);
                    }
                    reader.readAsDataURL(file);
                }
            });

            $('#icono_promocion').on('change', function() {
                const file = this.files[0];
                $("#file-icon-promo").text(file['name']);
                if (file) {
                    let reader = new FileReader();
                    reader.onload = function(event) {
                        $('#icon-promo-upload').attr('src', event.target.result);
                    }
                    reader.readAsDataURL(file);
                }
            });

            $('#image_pais_origen').on('change', function() {
                const file = this.files[0];
                $("#file-icon-pais").text(file['name']);
                if (file) {
                    let reader = new FileReader();
                    reader.onload = function(event) {
                        $('#icon-pais-upload').attr('src', event.target.result);
                    }
                    reader.readAsDataURL(file);
                }
            });
            tinymce.remove();
            tinymce.init({
                selector: '.tinymce',
                height: 100,
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
        },
        afterSuccess: function() {
            tinymce.remove();
            load();

        }
    });


    ModalCRUD.show({
        title: 'Compras',
        mode: 'lg',
        element: '.entity-show',
        form_element: '#form-noticia-relacionada-create',
        element_is_load: false,
        isLoadFromAjax: true,
        rules: rules,
        url: function(elemt) {
            return $(elemt).attr('href');
        },
        initialized: function() {
            //load_product_list();
        }
    });

    $(document).on('click', '.pagination li a', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');
        load(url);
    })
});


function eliminar($id, $url, $token) {
    swal({
            title: "Eliminar registro",
            text: "Estas seguro de eliminar este registro",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {

                $.ajax({
                    url: $url, // "{{ url('/dashboard/role/delete') }}",
                    method: 'post',
                    data: {
                        id: $id,
                        _token: $token
                    },
                    beforeSend: function() {
                        showLoading('Eliminando registro...');
                    },
                    success: function(dataJson) {
                        if (dataJson.rpt === 1) {
                            swal("Registro eliminado correctamente", {
                                    icon: "success",
                                })
                                .then((result) => {
                                    if (result) {
                                        load();
                                    }
                                });
                        }

                    }
                });


            }
        });
}

function activar($id, $url, $token) {
    swal({
            title: "Activar registro",
            text: "Estas seguro de activar?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {

                $.ajax({
                    url: $url, // "{{ url('/dashboard/role/active') }}",
                    method: 'post',
                    data: {
                        id: $id,
                        _token: $token
                    },
                    beforeSend: function() {
                        showLoading('Activando registro...');
                    },
                    success: function(dataJson) {
                        if (dataJson.rpt === 1) {
                            swal("Activado correctamente", {
                                    icon: "success",
                                })
                                .then((result) => {
                                    if (result) {
                                        load();
                                    }
                                });
                        }

                    }
                });


            }
        });
}

function desactivar($id, $url, $token) {
    swal({
            title: "Desactivar registro",
            text: "Estas seguro de desactivar",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {

                $.ajax({
                    url: $url, //"{{ url('/dashboard/role/desactive') }}",
                    method: 'post',
                    data: {
                        id: $id,
                        _token: $token
                    },
                    beforeSend: function() {
                        showLoading('Desactivando registro...');
                    },
                    success: function(dataJson) {
                        if (dataJson.rpt === 1) {
                            swal("Desactivado correctamente", {
                                    icon: "success",
                                })
                                .then((result) => {
                                    if (result) {
                                        load();
                                    }
                                });
                        }

                    }
                });


            }
        });
}

function load(url = null) {
    var filters = get_filters();
    var url = url ? url : url_marca_load;

    $.get(url, filters, function(data) {
        $('#table-content').html(data);
        init_functions();
    });
}

function load_product_list(url = null) {
    var filters = get_filters();
    var url = url ? url : url_producto_list_load;

    $.get(url, filters, function(data) {
        $('#table-content-product').html(data);
        //init_functions();
    });
}

var init_functions = function() {
    ModalCRUD.edit({
        title: 'Producto',
        mode: 'lg',
        element: '.edit-entity',
        element_is_load: true,
        form_element: '#form-update-product',
        isLoadFromAjax: false,
        url: function(element) {
            return $(element).attr("href");
        },
        initialized: function() {
            $("#cmb_categoria").select2({
                theme: "bootstrap4",
                placeholder: "Seleccione categoria",
                dropdownParent: $('.bootbox'),
                allowClear: true,
            });
            $('#poster').on('change', function() {
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
            $('#poster_detalle').on('change', function() {
                const file = this.files[0];
                $("#file-image-detalle").text(file['name']);
                if (file) {
                    console.log(file);
                    let reader = new FileReader();
                    reader.onload = function(event) {
                        $('#img-upload-detalle').attr('src', event.target.result);
                    }
                    reader.readAsDataURL(file);
                }
            });
            $('#icono_promocion').on('change', function() {
                const file = this.files[0];
                $("#file-icon-promo").text(file['name']);
                if (file) {
                    let reader = new FileReader();
                    reader.onload = function(event) {
                        $('#icon-promo-upload').attr('src', event.target.result);
                    }
                    reader.readAsDataURL(file);
                }
            });
            tinymce.remove();
            tinymce.init({
                selector: '.tinymce',
                height: 100,
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
        },
        afterSuccess: function() {
            tinymce.remove();
            load();
        }
    });
}