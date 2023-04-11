$(document).ready(function () {
    let current_lang = $('html')[0].lang;

    let sProcessing = "";
    let sLengthMenu = "";
    let sZeroRecords = "";
    let sInfo = "";
    let sInfoEmpty = "";
    let sInfoFiltered = "";
    let sInfoPostFix = "";
    let sSearch = "";
    let sUrl = "";
    let oPaginate = "";

    sProcessing = "loading ...";
    sLengthMenu = "Show _MENU_ Input";
    sZeroRecords = "No records found";
    sInfo = "Show _START_ to _END_ out of _TOTAL_ entry";
    sInfoEmpty = "Displaying 0 to 0 out of 0 records";
    sInfoFiltered = "(selected from sum of _MAX_ entered)";
    sInfoPostFix = "";
    sSearch = "Search:";
    sUrl = "";
    oPaginate = {'sFirst': "first", 'sPrevious': "previous", 'sNext': "next", 'sLast': "last"};

    
    $('#viewAllAdminUserList').DataTable({
        "paging": true,
        "deferRender": true,
        "lengthChange": true,
        "searching": true,
        "info": true,
        "dom": '<"container-fluid"<"row"<"col-sm-6"B><"col-sm-4"f><"col-sm-1"l >>>rtip',
        "buttons": [
            {
                'extend': 'copy',
                'exportOptions': {
                    'columns': [ 0, 1, 2, 3, 4, 5 ]
                }
            },
            {
                'extend': 'csv',
                'exportOptions': {
                    'columns': [ 0, 1, 2, 3, 4, 5 ]
                }
            },
            {
                'extend': 'excel',
                'exportOptions': {
                    'columns': [ 0, 1, 2, 3, 4, 5 ]
                }
            },
            {
                'extend': 'pdf',
                'exportOptions': {
                    'columns': [ 0, 1, 2, 3, 4, 5 ]
                }
            },
            {
                'extend': 'print',
                'exportOptions': {
                    'columns': [ 0, 1, 2, 3, 4, 5 ]
                }
            },
           
        ],
        "pageLength": 10,
        "processing": true,
        'language': {
            'sProcessing': sProcessing,
            //'sLengthMenu': sLengthMenu,
            "slengthMenu": [50,100,500,1000,2000,5000,10000,50000,100000],
            'sZeroRecords': sZeroRecords,
            'sInfo': sInfo,
            'sInfoEmpty': sInfoEmpty,
            'sInfoFiltered': sInfoFiltered,
            'sInfoPostFix': sInfoPostFix,
            'sSearch': sSearch,
            'sUrl': sUrl,
            'oPaginate': oPaginate
        }
    });

    $('#viewAllCategoryList').DataTable({
        "paging": true,
        "deferRender": true,
        "lengthChange": true,
        "searching": true,
        "info": true,
        "dom": '<"container-fluid"<"row"<"col-sm-6"B><"col-sm-4"f><"col-sm-1"l >>>rtip',     
        "buttons": [
            {
                'extend': 'copy',
                'exportOptions': {
                    'columns': [ 0, 1, 2, 3 ]
                }
            },
            {
                'extend': 'csv',
                'exportOptions': {
                    'columns': [ 0, 1, 2, 3 ]
                }
            },
            {
                'extend': 'excel',
                'exportOptions': {
                    'columns': [ 0, 1, 2, 3 ]
                }
            },
            {
                'extend': 'pdf',
                'exportOptions': {
                    'columns': [ 0, 1, 2, 3, 4 ]
                }
            },
            {
                'extend': 'print',
                'exportOptions': {
                    'columns': [ 0, 1, 2, 3 ]
                }
            },
           
        ],
        "pageLength": 10,
        "processing": true,
        'language': {
            'sProcessing': sProcessing,
            'sLengthMenu': sLengthMenu,
            'sZeroRecords': sZeroRecords,
            'sInfo': sInfo,
            'sInfoEmpty': sInfoEmpty,
            'sInfoFiltered': sInfoFiltered,
            'sInfoPostFix': sInfoPostFix,
            'sSearch': sSearch,
            'sUrl': sUrl,
            'oPaginate': oPaginate
        }
    }); 
    
    $('#viewAllSubscribersList').DataTable({
        "paging": true,
        "deferRender": true,
        "lengthChange": true,
        "searching": true,
        "info": true,
        "dom": '<"container-fluid"<"row"<"col-sm-6"B><"col-sm-4"f><"col-sm-1"l >>>rtip',       
        "buttons": [
            {
                'extend': 'copy',
                'exportOptions': {
                    'columns': [ 0, 1, 2,]
                }
            },
            {
                'extend': 'csv',
                'exportOptions': {
                    'columns': [ 0, 1, 2 ]
                }
            },
            {
                'extend': 'excel',
                'exportOptions': {
                    'columns': [ 0, 1, 2 ]
                }
            },
            {
                'extend': 'pdf',
                'exportOptions': {
                    'columns': [ 0, 1, 2 ]
                }
            },
            {
                'extend': 'print',
                'exportOptions': {
                    'columns': [ 0, 1, 2, 3, 4 ]
                }
            },
           
        ],
        "pageLength": 10,
        "processing": true,
        'language': {
            'sProcessing': sProcessing,
            'sLengthMenu': sLengthMenu,
            'sZeroRecords': sZeroRecords,
            'sInfo': sInfo,
            'sInfoEmpty': sInfoEmpty,
            'sInfoFiltered': sInfoFiltered,
            'sInfoPostFix': sInfoPostFix,
            'sSearch': sSearch,
            'sUrl': sUrl,
            'oPaginate': oPaginate
        }
    });

   
    $('#viewAllTemplateList').DataTable({
        "paging": true,
        "deferRender": true,
        "lengthChange": true,
        "searching": true,
        "info": true,
        "dom": '<"container-fluid"<"row"<"col-sm-6"B><"col-sm-4"f><"col-sm-1"l >>>rtip',       
        "buttons": [
            {
                'extend': 'copy',
                'exportOptions': {
                    'columns': [ 0, 1, 2 ]
                }
            },
            {
                'extend': 'csv',
                'exportOptions': {
                    'columns': [ 0, 1, 2 ]
                }
            },
            {
                'extend': 'excel',
                'exportOptions': {
                    'columns': [ 0, 1, 2 ]
                }
            },
            {
                'extend': 'pdf',
                'exportOptions': {
                    'columns': [ 0, 1, 2 ]
                }
            },
            {
                'extend': 'print',
                'exportOptions': {
                    'columns': [ 0, 1, 2, 3, 4, 5 ]
                }
            },
           
        ],
        "pageLength": 10,
        "processing": true,
        'language': {
            'sProcessing': sProcessing,
            "slengthMenu": [50,100,500,1000,2000,5000,10000,50000,100000],
            'sZeroRecords': sZeroRecords,
            'sInfo': sInfo,
            'sInfoEmpty': sInfoEmpty,
            'sInfoFiltered': sInfoFiltered,
            'sInfoPostFix': sInfoPostFix,
            'sSearch': sSearch,
            'sUrl': sUrl,
            'oPaginate': oPaginate
        }
    });

    
    $('#viewAllPlanList').DataTable({
        "paging": true,
        "deferRender": true,
        "lengthChange": true,
        "searching": true,
        "info": true,
        "dom": '<"container-fluid"<"row"<"col-sm-6"B><"col-sm-4"f><"col-sm-1"l >>>rtip',  
        "buttons": [
            {
                'extend': 'copy',
                'exportOptions': {
                    'columns': [ 0, 1, 2, 3, 4, 5 ]
                }
            },
            {
                'extend': 'csv',
                'exportOptions': {
                    'columns': [ 0, 1, 2, 3, 4, 5 ]
                }
            },
            {
                'extend': 'excel',
                'exportOptions': {
                    'columns': [ 0, 1, 2, 3, 4, 5 ]
                }
            },
            {
                'extend': 'pdf',
                'exportOptions': {
                    'columns': [ 0, 1, 2, 3, 4, 5 ]
                }
            },
            {
                'extend': 'print',
                'exportOptions': {
                    'columns': [ 0, 1, 2, 3, 4, 5 ]
                }
            },
           
        ],
        "pageLength": 10,
        "processing": true,
        'language': {
            'sProcessing': sProcessing,
            "slengthMenu": [50,100,500,1000,2000,5000,10000,50000,100000],
            'sZeroRecords': sZeroRecords,
            'sInfo': sInfo,
            'sInfoEmpty': sInfoEmpty,
            'sInfoFiltered': sInfoFiltered,
            'sInfoPostFix': sInfoPostFix,
            'sSearch': sSearch,
            'sUrl': sUrl,
            'oPaginate': oPaginate
        }
    });
    
    $('#viewAllCouponList').DataTable({
        "paging": true,
        "deferRender": true,
        "lengthChange": true,
        "searching": true,
        "info": true,
        "dom": '<"container-fluid"<"row"<"col-sm-6"B><"col-sm-4"f><"col-sm-1"l >>>rtip',   
        "buttons": [
            {
                'extend': 'copy',
                'exportOptions': {
                    'columns': [ 0, 1, 2, 3, 4, 5 ]
                }
            },
            {
                'extend': 'csv',
                'exportOptions': {
                    'columns': [ 0, 1, 2, 3, 4, 5 ]
                }
            },
            {
                'extend': 'excel',
                'exportOptions': {
                    'columns': [ 0, 1, 2, 3, 4, 5 ]
                }
            },
            {
                'extend': 'pdf',
                'exportOptions': {
                    'columns': [ 0, 1, 2, 3, 4, 5 ]
                }
            },
            {
                'extend': 'print',
                'exportOptions': {
                    'columns': [ 0, 1, 2, 3, 4, 5 ]
                }
            },
           
        ],
        "pageLength": 10,
        "processing": true,
        'language': {
            'sProcessing': sProcessing,
            "slengthMenu": [50,100,500,1000,2000,5000,10000,50000,100000],
            'sZeroRecords': sZeroRecords,
            'sInfo': sInfo,
            'sInfoEmpty': sInfoEmpty,
            'sInfoFiltered': sInfoFiltered,
            'sInfoPostFix': sInfoPostFix,
            'sSearch': sSearch,
            'sUrl': sUrl,
            'oPaginate': oPaginate
        }
    });
    
    $('#viewAllStoreList').DataTable({
        "paging": true,
        "deferRender": true,
        "lengthChange": true,
        "searching": true,
        "info": true,        
        "dom": '<"container-fluid"<"row"<"col-sm-6"B><"col-sm-4"f><"col-sm-1"l >>>rtip',   
        "buttons": [
            {
                'extend': 'copy',
                'exportOptions': {
                    'columns': [ 0, 1, 2, 3, 4, 5 ]
                }
            },
            {
                'extend': 'csv',
                'exportOptions': {
                    'columns': [ 0, 1, 2, 3, 4, 5 ]
                }
            },
            {
                'extend': 'excel',
                'exportOptions': {
                    'columns': [ 0, 1, 2, 3, 4, 5 ]
                }
            },
            {
                'extend': 'pdf',
                'exportOptions': {
                    'columns': [ 0, 1, 2, 3, 4, 5 ]
                }
            },
            {
                'extend': 'print',
                'exportOptions': {
                    'columns': [ 0, 1, 2, 3, 4, 5 ]
                }
            },
           
        ],
        "pageLength": 10,
        "processing": true,
        'language': {
            'sProcessing': sProcessing,
            //'sLengthMenu': sLengthMenu,
            "slengthMenu": [50,100,500,1000,2000,5000,10000,50000,100000],
            'sZeroRecords': sZeroRecords,
            'sInfo': sInfo,
            'sInfoEmpty': sInfoEmpty,
            'sInfoFiltered': sInfoFiltered,
            'sInfoPostFix': sInfoPostFix,
            'sSearch': sSearch,
            'sUrl': sUrl,
            'oPaginate': oPaginate
        }
    });

    $('#invoiceList').DataTable({
        "paging": true,
        "deferRender": true,
        "lengthChange": true,
        "searching": true,
        "info": true,        
        "dom": '<"container-fluid"<"row"<"col-sm-6"B><"col-sm-4"f><"col-sm-1"l >>>rtip',   
        "buttons": [
            
            {
                'extend': 'print',
                'exportOptions': {
                    'columns': [ 0, 1, 2]
                }
            },
           
        ],
        "pageLength": 10,
        "processing": true,
        'language': {
            'sProcessing': sProcessing,
            //'sLengthMenu': sLengthMenu,
            "slengthMenu": [50,100,500,1000,2000,5000,10000,50000,100000],
            'sZeroRecords': sZeroRecords,
            'sInfo': sInfo,
            'sInfoEmpty': sInfoEmpty,
            'sInfoFiltered': sInfoFiltered,
            'sInfoPostFix': sInfoPostFix,
            'sSearch': sSearch,
            'sUrl': sUrl,
            'oPaginate': oPaginate
        }
    });

    //$(document).ready(function() {
        $('#invoiceList').DataTable( {
            "dom": '<"container-fluid"<"row"<"col-sm-6"B><"col-sm-4"f><"col-sm-1"l >>>rtip', 
            buttons: [
                'print'
            ]
        } );
    //} );
    $('.dataTables_length').addClass('bs-select');
});

