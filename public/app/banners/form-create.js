
jQuery(function() {
  $("#form-banner").trigger("reset");
  tinymce.init({
      selector: '.tinymce',
      height: 100,
      plugins: [
          'advlist autolink lists link image charmap print preview anchor',
          'searchreplace visualblocks code fullscreen',
          'insertdatetime media table contextmenu paste code textcolor'
      ],
      toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | forecolor backcolor',
      
  });
  $("#cmb_menu").select2({
        allowClear: true,
        placeholder: "Seleccione menú"
    });
    $("#cmb_tipo_banner").select2({
        allowClear: true,
        placeholder: "Seleccione tipo"
    });
  ///tinymce.get('txt_descripcion_amigo').setContent('');
  var form = $("#form-banner");

  form.validate({

      /* @validation states + elements
      ------------------------------------------- */
      ignore: [],
      errorClass: "state-error",
      validClass: "state-success",
      errorElement: "em",
        
      /*  rules
      ------------------------------------------ */
      rules : {
        menu_web_id: {required: true},
        tipo_banner_id: {required: true},
        //title: {required: true},
        //description: {required: true},
      },

      /* @validation error messages
      ---------------------------------------------- */
      messages: {
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
          }
          else {
              error.insertAfter(element.parent());
              error.insertAfter(element.closest(".field"));
          }
      }
  });

form.on('submit',function(e){
    e.preventDefault();
    //console.log(this);
    var fields = new FormData(this);

    if (!form.valid()) {
        $("#btn-submit-banner").removeAttr("disabled");
       return false;
    }      
   if(jQuery.trim(jQuery("#id_ajax").val()) == ""){
       $("#btn-submit-banner").attr("disabled", true);
       jQuery("#id_ajax").val('1');
       $.ajax({
            url: $(this).attr('action'),
            type: 'post',
            data: fields,
            dataType: 'json',
            contentType: false,
            processData: false,
            
            beforeSend: function(){
              showLoading('procesando...');
            },
            success:  function(data){
                window.location.replace(data.route);
                $("#btn-submit-banner").removeAttr("disabled");
                jQuery("#id_ajax").val("");
            },
            error: function(){
               $("#btn-submit-banner").removeAttr("disabled");
               jQuery("#id_ajax").val("");
            }
        });
   }      
});


});

 
