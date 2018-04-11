$( document ).ready(function() {
    
   $('#reportrange').hide();
   $('#dataTables_filter').hide();

   
   
 
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
    var section = 'transactions';
    var cols= 'id, fullname, gender, phone';

    var myTable =
        $('#dynamic-table').DataTable( {
            "processing": true,
            "serverSide": true,
            "searchDelay": 5000,
            "lengthMenu": [ [10, 20, 30, 50,-1],  [10, 20, 30, 50, 'All'] ],
            "order": [[ 1, 'desc' ]],

            bAutoWidth: false,
            ajax: {
                url: "ajax/initServerSide.php", // json datasource
                data: {section: section, cols: cols},
                type: "post"  // method  , by default get

            }//,
            
           // "dom": '<"toolbar">lfrtip'//,
           /* columns: [
                {
                    searchable: false,
                    orderable: false,
                },
                {
                    searchable: false,
                    orderable: false
                },
                {
                   searchable: true,
                    orderable: false
                },
                {
                    searchable: true,
                     orderable: false
                 },
                
                {
                    "mRender": function ( data, type, row ) {
                       // return ' <a data-toggle="tooltip-address" class="btn btn-secondary" data-html="true" title="'+data+'"><i class="fa fa-location-arrow fa-2x "></i></a> ';
                       return '<span data-toggle="tooltip" title="' + data + '"><i class="fa fa-location-arrow fa-2x "></i></span>';
                },

                    searchable: false,
                    orderable: false
                },
                {
                    searchable: true,
                     orderable: false
                 },
               
                {
                    searchable: true,
                    orderable: false
                },
                {
                    searchable: true,
                    orderable: false
                }
                ,
                {
                    searchable: true,
                    orderable: false
                }
                ,
                {
                    searchable: true,
                    orderable: false
                }
                ,
                {
                    searchable: true,
                    orderable: false
                }
                ,
                {
                    searchable: true,
                    orderable: false
                }
                ,
                {
                    "mRender": function ( data, type, row ) {
                        //return '<a data-toggle="tooltip-msg" class="btn btn-secondary" data-html="true" title="'+data+'"><i class="fa fa-info-circle fa-2x "></i></a>';
                        return '<span data-toggle="tooltip" title="' + data + '"><i class="fa fa-info-circle fa-2x "></i></span>';
                },

                    searchable: false,
                    orderable: false
                }
                 
               
            ],*/
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
      
         
         
         param+= '& utility_reference:'+$('#utility_ref').val();          
         param+= '& transid:'+$('#transid').val();   
         //param+= '& result:'+$('#result').val();
         param+= '& result:'+$('#isresult input:radio:checked').val();
         param+= '& download:'+$('#isdownload input:radio:checked').val();
            
        
         //send to datatables server side     
        myTable.columns(0).search(param).draw();
        
        $('#myModal').attr('data-dismiss','modal'); 
        $('#myModal').modal('hide');

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
         
    
        
    });
   

   

//End of the datable




});


