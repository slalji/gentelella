$( document ).ready(function() {
    
   $('#reportrange').hide();
   $('#dataTables_filter').hide();

   $.ajax({
    "url": " ajax/utility_codes.php",
    type: "get",   
    "success": function(res, status, xhr) {
      $('#loading').html('');
       var _html = JSON.stringify(xhr);// document.location.href ="ajax/download.php";
       $('#utility_code').html(_html);                   
    },
    "error": function(res, status, xhr) {
       alert('Err:' ); 
    }
   
}); 
   
 
});

$('#check-date').change(function(){
    if($(this).prop("checked")) {
      $('#reportrange').show();
    } else {
      $('#reportrange').hide();
    }
  });

  
jQuery(function($) {
  
    //initiate dataTables plugin
    //var section = 'transactions';
     var utility_code = 'SPCASHIN';
     var cols= 'fullname,  address, utility_type, amount,utility_reference, msisdn, reference, transid, result';

    var myTable =
        $('#dynamic-table').DataTable( {
            "processing": true,
            "serverSide": true,
            "searchDelay": 5000,
            "start":0,
            "length":10,
            "lengthMenu": [ [10, 50, 100, 150, 350, 500, 750, 1000, -1],  [10, 50, 100, 150, 350, 500, 750, 1000, 'All'] ],
            "order": [[ 1, 'desc' ]],

            bAutoWidth: false,
            ajax: {
                url: "ajax/initServerSide.php", // json datasource
                data: {utility_code: utility_code, cols: cols},
                type: "post"  // method  , by default get

            },
            
            "dom": '<"toolbar">lfrtip'
            
        } );
    $("div.toolbar").html('<div class="dataTables_length"></div><div><a href="#" id="advsearch" data-toggle="modal" data-target="#myModal" class="btn btn-primary">Advanced Search</a><div>');
    /* Apply the tooltips */
    myTable.on('draw.dt', function () {
        $('[data-toggle="tooltip"]').tooltip();
    });

    //$('#my-table_filter').hide();

     /* $.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group btn-overlap';

    new $.fn.dataTable.Buttons( myTable, {
        buttons: [
          {
                "extend": "colvis",
                "text": "<i class='fa fa-eye-slash bigger-110 blue'></i> <span class='hidden'>Show/hide columns</span>",
                "className": "btn btn-white btn-primary btn-bold",
                //columns: ':not(:first):not(:last)'
                columns: ':not(:first)'
            },
            {
                "extend": "copy",
                "text": "<i class='fa fa-copy bigger-110 pink'></i> <span class='hidden'>Copy to clipboard</span>",
                "className": "btn btn-white btn-primary btn-bold"
            },
            {
                "extend": "csv",
                "text": "<i class='fa fa-file-excel-o bigger-110 green'></i> <span class='hidden'>Export to CSV</span>",
                "className": "btn btn-white btn-primary btn-bold"
            },
            {
                "extend": "excel",
                "text": "<i class='fa fa-file-excel-o bigger-110 green'></i> <span class='hidden'>Export to Excel</span>",
                "className": "btn btn-white btn-primary btn-bold"
            },
            {
                "extend": "pdf",
                "text": "<i class='fa fa-file-pdf-o bigger-110 red'></i> <span class='hidden'>Export to PDF</span>",
                "className": "btn btn-white btn-primary btn-bold"
            },
            {
                "extend": "print",
                "text": "<i class='fa fa-print bigger-110 grey'></i> <span class='hidden'>Print</span>",
                "className": "btn btn-white btn-primary btn-bold",
                autoPrint: false,
                message: 'This print was produced using the Print button for DataTables'
            }
            {
                
                "text": "<i class='fa fa-file-excel-o  bigger-110 green'></i> <span class='hidden'>Export CSV</span>",
                "className": "btn btn-white btn-default btn-bold ",
                "action": function (e, dt, node, config) {
                    $.ajax({
                        "url": " ajax/initServerSide.php?download=yes",
                        "data": dt.ajax.params(),
                        "success": function(res, status, xhr) {
                            var csvData = new Blob([res], {type: 'text/csv;charset=utf-8;'});
                            var csvURL = window.URL.createObjectURL(csvData);
                            var tempLink = document.createElement('a');
                            tempLink.href = csvURL;
                            tempLink.setAttribute('download', 'data.csv');
                            tempLink.click();
                        }
                    });
                } 
            }   
            
           
        ]
    } );
    //myTable.buttons().container().appendTo( $('.tableTools-container') );
    myTable.buttons().container().appendTo( $('.tableTools-container') );
*/
    //style the message box
    var defaultCopyAction = myTable.button(1).action();
    myTable.button(1).action(function (e, dt, button, config) {
        defaultCopyAction(e, dt, button, config);
        $('.dt-button-info').addClass('gritter-item-wrapper gritter-info gritter-center white');
    });


    var defaultColvisAction = myTable.button(0).action();
    myTable.button(0).action(function (e, dt, button, config) {

        defaultColvisAction(e, dt, button, config);


        if($('.dt-button-collection > .dropdown-menu').length == 0) {
            $('.dt-button-collection')
                .wrapInner('<ul class="dropdown-menu dropdown-light dropdown-caret dropdown-caret" />')
                .find('a').attr('href', '#').wrap("<li />")
        }
        $('.dt-button-collection').appendTo('.tableTools-container .dt-buttons')
    });

    ////

    setTimeout(function() {
        $($('.tableTools-container')).find('a.dt-button').each(function() {
            var div = $(this).find(' > div').first();
            if(div.length == 1) div.tooltip({container: 'body', title: div.parent().text()});
            else $(this).tooltip({container: 'body', title: $(this).text()});
        });
    }, 500);



    /********************************/
    //add tooltip for small view action buttons in dropdown menu
    $('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});

    //tooltip placement on right or left
    function tooltip_placement(context, source) {
        var $source = $(source);
        var $parent = $source.closest('table')
        var off1 = $parent.offset();
        var w1 = $parent.width();

        var off2 = $source.offset();
        //var w2 = $source.width();

        if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
        return 'left';
    }

    
    var start = moment().subtract(14, 'days');
    var end = moment();

    function cb(start, end) {
       
       $('#reportrange span').html(start.format('YYYY-MM-DD') + ' | ' + end.format('YYYY-MM-DD'));
    }

    $('#reportrange').daterangepicker({
        startDate: start,
       endDate: end,
        "autoUpdateInput": false, 
        "dateLimit": {
            "days": 14
        },
      locale: {
          cancelLabel: 'Clear'
      }

    }, cb);

    cb(start, end);
   
    
    $("#reportrange").on('apply.daterangepicker', function(ev, picker) {

        
        start = picker.startDate.format('YYYY-MM-DD');
        end =  picker.endDate.format('YYYY-MM-DD');

        $(this).val(picker.startDate.format('YYYY-MM-DD') + ' | ' + picker.endDate.format('YYYY-MM-DD'));
        document.getElementById('date-text').innerHTML = start +' | ' + end;
        var daterange = $('#date-text').html();
       
    });

    $("#reportrange").on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
        myTable.draw();
    });
    /*var d1 = [
        [201001,118],[200952,112],[200951,102],[200950,97],[200949,93],
        [200948,41],[200947,10],[200947,0]];
        
        var d2 = [
        [201001,33],[200952,31],[200951,31],[200950,25],[200949,23],
        [200948,12],[200947,0],[200947,0]];
        
        $.plot($("#placeholder"),
           [{data:d1,lines:{show: true},
             points:{show: true},label:"Mountain"},
            {data:d2,lines:{show: true},points:{show: true},label:"Valley"}],
            {xaxis: {tickSize:1, tickDecimals:0 }}
        );
        
        //});*/
// Date range script - END of the script

   /* $.fn.dataTableExt.afnFiltering.push(
        function( oSettings, aData, iDataIndex ) {

            var grab_daterange = $("#reportrange").val();
            var give_results_daterange = grab_daterange.split(" to ");
            var filterstart = give_results_daterange[0];
            var filterend = give_results_daterange[1];
            var iStartDateCol = 1; //using column 2 in this instance
            var iEndDateCol = 1;
            var tabledatestart = aData[iStartDateCol];
            var tabledateend= aData[iEndDateCol];


            if ( !filterstart && !filterend )
            {
                return true;
            }
            else if ((moment(filterstart).isSame(tabledatestart) || moment(filterstart).isBefore(tabledatestart)) && filterend === "")
            {
                return true;
            }
            else if ((moment(filterstart).isSame(tabledatestart) || moment(filterstart).isAfter(tabledatestart)) && filterstart === "")
            {
                return true;
            }
            else if ((moment(filterstart).isSame(tabledatestart) || moment(filterstart).isBefore(tabledatestart)) && (moment(filterend).isSame(tabledateend) || moment(filterend).isAfter(tabledateend)))
            {
                return true;
            }
            return false;
        }
    );
*/
    $('#save').on('click', function(){
        var param = {};
        
        if($("#check-date").prop("checked")) {
            param= 'fulltimestamp:'+$('#date-text').html();
          } 
        else {
            param= 'fulltimestamp:';
          }        
         
         param+= '& utility_code:'+$('#utility_code').val();          
         //param+= '& transid:'+$('#transid').val();   
         //param+= '& result:'+$('#result').val();
         //param+= '& result:'+$('#isresult input:radio:checked').val();
         param+= '& download:'+$('#isdownload input:radio:checked').val();
            
        
         //send to datatables server side     
       myTable.columns(0).search(param).draw();
        
        $('#myModal').attr('data-dismiss','modal'); 
        $('#myModal').modal('hide');

        //if download is clicked, download data
        if ($('#isdownload input:radio:checked').val() == 'yes'){
          
            MyTimestamp = new Date().getTime(); // Meant to be global var
            $.ajax({
             "url": " ajax/download.php",
             type: "post",
             "data": {fulltimestamp:$('#date-text').html(), util_ref:$('#utility_ref').val(), transid:$('#transid').val(),result:$('#result').val(),download:'yes' },
             beforeSend: function() {
                // setting a timeout
                $('#loading').html('loading...');
                //document.location.href ="ajax/download.php";
            },
             "success": function(res, status, xhr) {
               
               $('#loading').html('');
                // document.location.href ="ajax/download.php";
                var csvData = new Blob([res], {type: 'text/csv;charset=utf-8;'});
                            var csvURL = window.URL.createObjectURL(csvData);
                            var tempLink = document.createElement('a');
                            tempLink.href = csvURL;
                            tempLink.setAttribute('download', 'export.csv');
                            tempLink.click();
            
                            
             },
             "error": function(res, status, xhr) {
                alert('Err:' ); 
             }
            
         }); 
         //alert();
        }

        //draw chart
        /*var d1 = [
            [50,118],[51,112],[52,102],[53,97],[54,93],
            [55,41],[56,10],[57,0]];
            
            var d2 = [
            [50,33],[51,31],[52,31],[53,25],[54,23],
            [55,12],[56,0],[57,0]];
            
        */
       var d1 = [[0,5247000],[1,8201900],[2,4007001],[3,4690000],[4,9536000],[5,7629000],[6,4080000],[7,5081500],[8,7370000],[9,8848301],[10,8880000],[11,6270000],[12,8899000],[13,4077500],[14,7497000],[15,4469500],[16,4763000],[17,3734000],[18,9090000],[19,5790000],[20,2617000],[21,5380000],[22,1500000],[23,10332000],[24,7350000],[25,8135000],[26,5730000],[27,7807000],[28,6812500],[29,5521001],[30,6412000],[31,6818000],[32,7246500],[33,5080000],[34,4682000],[35,2656002],[36,7165000],[37,5870000],[38,4706000],[39,6765000],[40,9231000],[41,8727000],[42,8263000],[43,5435000],[44,1778000],[45,9905500],[46,6180000],[47,5405000],[48,5672000],[49,5566000],[50,6408000],[51,5677500],[52,6594000],[53,6059000],[54,6558000],[55,5817000],[56,5706100],[57,7813000],[58,6144000],[59,3170000]];
       
       $.ajax({
        "url": " ajax/plot.php",
        type: "post",
        "data": {utility_code:$('#utility_code').val()},
        beforeSend: function() {
           // setting a timeout
           $('#placeholder').html('loading...');
           //document.location.href ="ajax/download.php";
       },
        "success": function(data) {
            $('#placeholder').html('');
            var obj = (JSON.parse(data));
            var arr ='';
            $i=0;
            d1_label=(obj[0][0].label);
            d1=(obj[0][0].data);
            d2_label=(obj[1][0].label);
           d2=(obj[1][0].data);
           d3_label=(obj[2][0].label);
           d3=(obj[2][0].data);
                $.plot($("#placeholder"),
                [{data:d1,bars:{show: true},
                    points:{show: true},label:d1_label},
                    {data:d2,bars:{show: true},points:{show: true},label:d2_label},
                    {data:d3,bars:{show: true},points:{show: true},label:d3_label}
                ],
                    {xaxis: {tickSize:1, tickDecimals:0,  label: "Days", }}
                );
             
           
        },
        "error": function(res, status, xhr) {
           alert('Err:' ); 
        }
    });
});

   

   

//End of the datable




});


