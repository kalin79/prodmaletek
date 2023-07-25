$(document).on('ready', function(){   
    $(".delete-file").on("click", function(e){
        e.preventDefault();
        var hdn_delete = $(this).next(".file_exist").val();
        $(this).next().next(".file_delete").val(hdn_delete);
        jQuery(this).parent().parent().parent().parent().parent().parent().find('.delete-file-conntainer').removeClass('none');

        jQuery(this).parent().parent().parent().parent().parent().addClass('none');
        
    });
    
    jQuery('.refresh-file').bind('click', function(e){
        e.preventDefault();
        jQuery(this).parent().parent().parent().addClass('none');
        jQuery(this).parent().parent().parent().parent().find('.hover-img').removeClass('none');
        jQuery(this).parent().parent().parent().parent().find('.delete-file').next().next(".file_delete").val('');
    });
    
    if($("#upld_warranty").is('*')){
        $("#upld_warranty").fileinput({
            language: "es",
            showUpload:false, 
            showCaption: false, 
            showRemove:false,
            previewFileType:'any',
            autoReplace: true,
            allowedFileExtensions: ["jpg", "png", "gif"]
        }); 
    }
    
    
    jQuery('.link-none').bind('click', function(e){
        e.preventDefault();
    });
});

