
jQuery(function() {
    tinymce.init({
        selector: '.tinymce',
        height: 100,
        plugins: [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table contextmenu paste code'
        ],
        toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        readonly : 1
    });
    $("#cmb_menu").select2({
          allowClear: true,
          placeholder: "Seleccione menú"
      });
      $("#cmb_tipo_banner").select2({
          allowClear: true,
          placeholder: "Seleccione tipo"
      });
  });
  
   
  