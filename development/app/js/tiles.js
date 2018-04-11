$( document ).ready(function() {
    $(this).scrollTop(0);

   $.ajax({
    "url": " ajax/getTiles.php",
    type:'POST',
    beforeSend: function() {
        // setting a timeout
        $('#tile').html('<div style="margin-left:100px">loading...</div>');
        //document.location.href ="ajax/download.php";
    },
    success: function (data) {
        $_html = '';
        $.each(JSON.parse(data), function(index, value) {
            console.log(value.utility_code);
            $_html += '<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count"> <span class="count"><i class="fa fa-wrench"></i> '+value.utility_code+'</span><div class="count_top">'+value.amnt+'</div><span class="count_bottom"><i class="green">'+value.cnt+'</i> Total Count</span></div>';
        });
        $('#tile').html($_html);
    },
    error: function (jqXHR, textStatus, errorThrown) {
        console.log (textStatus);
        console.log (errorThrown);
    }
   
    }); 
}); 