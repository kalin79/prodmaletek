jQuery(function() {
    load();

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
            //title: { required: true },
            //description: {required: true},
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
        title: { required: true }
    }

    ModalCRUD.create({
        title: 'Banners',
        element: '.entity-create',
        mode: 'lg',
        form_element: '#form-banners-create',
        element_is_load: true,
        isLoadFromAjax: false,
        rules: rules,
        url: function(elemt) {
            return $(elemt).attr('href');
        },
        initialized: function() {
            load_functions();
        },
        afterSuccess: function() {
            load();
        }
    });
    ModalCRUD.edit({
        title: 'Banners',
        element: '.edit-entity',
        element_is_load: true,
        form_element: '#form-banners-edit',
        isLoadFromAjax: true,
        rules: rules,
        url: function(element) {
            return $(element).attr("href");
        },
        initialized: function() {
            load_functions();
        },
        afterSuccess: function() {
            load();
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
            title: "Eliminar Registro",
            text: "Estas seguro de eliminar este registro",
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
            title: "Activar Registro",
            text: "Estas seguro de activar?",
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
                        showLoading('Activando registro...');
                    },
                    success: function(dataJson) {
                        if (dataJson.rpt === 1) {
                            load();
                            swal("Activado correctamente", {
                                    icon: "success",
                                })
                                .then((result) => {
                                    if (result) {

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
            title: "Desactivar Registro",
            text: "Estas seguro de desactivar",
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
                        showLoading('Desactivando registro...');
                    },
                    success: function(dataJson) {
                        if (dataJson.rpt === 1) {
                            load();
                            swal("Desactivado correctamente", {
                                    icon: "success",
                                })
                                .then((result) => {
                                    if (result) {

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
    var url = url ? url : url_banner_load;

    $.get(url, filters, function(data) {
        $("#loading").remove();
        $('#table-content').html(data);
        init_functions();
    });
}

var init_functions = function() {
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
}

var load_functions = function() {
    $('#avatar').on('change', function() {
        const file = this.files[0];
        $("#file-desktop").text(file['name']);
        if (file) {
            let reader = new FileReader();
            reader.onload = function(event) {
                $('#img-upload').attr('src', event.target.result);
            }
            reader.readAsDataURL(file);
        }
    });

    $('#image_mobile').on('change', function() {
        const file = this.files[0];
        $("#file-mobile").text(file['name']);
        if (file) {
            let reader = new FileReader();
            reader.onload = function(event) {
                $('#img-upload-mobile').attr('src', event.target.result);
            }
            reader.readAsDataURL(file);
        }
    });
}

var update_oder = function(page_id_array) {
    $.ajax({
        url: update_order_banner,
        method: "POST",
        data: { page_id_array: page_id_array },
        success: function() {
            load();
        }
    })
}
