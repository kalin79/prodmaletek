$(document).on('ready', function(){
   var range_date = $("#range-date").val();
   
    $.get(url_date_range, {range_type: range_date}, function(data){
        if (data.start_date) {
            $("#txt_start-date").val(data.start_date);
            $("#txt_end-date").val(data.end_date);
        }
    });

    $("#range-date").on("change", function() {
        if ($(this).val() == 'customize_range') {
            $(".filter-range-date").removeAttr("readonly");
            $("#txt_start-date").focus();
            $("#txt_end-date").focus();
            $("#txt_start-date").focus();
        } else {
            $(".filter-range-date").attr("readonly", true);
        }
        
        $.get(url_date_range, {range_type: $(this).val()}, function(data){
            if (data.start_date) {
                $("#txt_start-date").val(data.start_date);
                $("#txt_end-date").val(data.end_date);
            }
        });
    });

});
        
