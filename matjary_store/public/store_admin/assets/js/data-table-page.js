$(document).ready(function(){
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
    let copyBtn = "";
    let csvBtn = "";
    let excelBtn = "";
    let pdfBtn = "";
    let printBtn = "";

    if (current_lang == 'ar') {
        sProcessing = "جارٍ التحميل...";
        sLengthMenu = "أظهر _MENU_ مدخلات";
        sZeroRecords = "لم يعثر على أية سجلات";
        sInfo = "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل";
        sInfoEmpty = "يعرض 0 إلى 0 من أصل 0 سجل";
        sInfoFiltered = "(منتقاة من مجموع _MAX_ مُدخل)";
        sInfoPostFix = "";
        sSearch = "ابحث:";
        sUrl = "";
        oPaginate = {'sFirst': "الأول", 'sPrevious': "السابق", 'sNext': "التالي", 'sLast': "الأخير"};
        copyBtn = "ينسخ";
        csvBtn = "CSV";
        excelBtn = "اكسل";
        pdfBtn = "PDF";
        printBtn = "مطبعة";
    } else {
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
        copyBtn = "Copy";
        csvBtn = "CSV";
        excelBtn = "Excel";
        pdfBtn = "PDF";
        printBtn = "Print";
    }

    $('#viewAllProductList').DataTable({
        'paging': true,
        'deferRender': true,
        'lengthChange': true,
        'searching': true,
        'info': true,
        'dom': '<"container-fluid"<"row"<"col-sm-6"B><"col-sm-4"f><"col-sm-1"l >>>rtip',
        'buttons': [
            'copy', 'csv', 'excel', 'pdf', 'print' 
        ],
        'pageLength': 10,
        'processing': true,
        'columnDefs': [
            { "orderable": false, "targets": [2, 7, 8 ] }
        ],
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
            'oPaginate': oPaginate,
            'buttons': {
                copy    : copyBtn,
                csv     : csvBtn,
                excel   : excelBtn,
                pdf     : pdfBtn,
                print   : printBtn
            }

        }
    });

    $('#viewAllProductCategoryList').DataTable({
        'paging': true,
        'deferRender': true,
        'lengthChange': true,
        'searching': true,
        'info': true,
        'dom': '<"container-fluid"<"row"<"col-sm-6"B><"col-sm-4"f><"col-sm-1"l >>>rtip',
        'buttons': [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        'pageLength': 10,
        'processing': true,
        'columnDefs': [
            { "orderable": false, "targets": [0, 2, 5, 6 ] }
        ],
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
            'oPaginate': oPaginate,
            'buttons': {
                copy    : copyBtn,
                csv     : csvBtn,
                excel   : excelBtn,
                pdf     : pdfBtn,
                print   : printBtn
            }
        }
    });
    
    $('#viewAllProductBrandList').DataTable({
        'paging': true,
        'deferRender': true,
        'lengthChange': true,
        'searching': true,
        'info': true,
        'dom': '<"container-fluid"<"row"<"col-sm-6"B><"col-sm-4"f><"col-sm-1"l >>>rtip',
        'buttons': [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        'pageLength': 10,
        'processing': true,
        'columnDefs': [
            { "orderable": false, "targets": [0, 2 , 4 , 5 ] }
        ],
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
            'oPaginate': oPaginate,
            'buttons': {
                copy    : copyBtn,
                csv     : csvBtn,
                excel   : excelBtn,
                pdf     : pdfBtn,
                print   : printBtn
            }
        }
    });

    $('#viewAllProductColorList').DataTable({
        'paging': true,
        'deferRender': true,
        'lengthChange': true,
        'searching': true,
        'info': true,
        'dom': '<"container-fluid"<"row"<"col-sm-6"B><"col-sm-4"f><"col-sm-1"l >>>rtip',
        'buttons': [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        'pageLength': 10,
        'processing': true,
        'columnDefs': [
            { "orderable": false, "targets": [ 4 ] }
        ],
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
            'oPaginate': oPaginate,
            'buttons': {
                copy    : copyBtn,
                csv     : csvBtn,
                excel   : excelBtn,
                pdf     : pdfBtn,
                print   : printBtn
            }
        }
    });

    $('#viewAllProductSizeList').DataTable({
        'paging': true,
        'deferRender': true,
        'lengthChange': true,
        'searching': true,
        'info': true,
        'dom': '<"container-fluid"<"row"<"col-sm-6"B><"col-sm-4"f><"col-sm-1"l >>>rtip',
        'buttons': [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        'pageLength': 10,
        'processing': true,
        'ordering': true,
        'columnDefs': [
            { "orderable": false, "targets": [ 0 , 4 ] }
        ],
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
            'oPaginate': oPaginate,
            'buttons': {
                copy    : copyBtn,
                csv     : csvBtn,
                excel   : excelBtn,
                pdf     : pdfBtn,
                print   : printBtn
            }
        }
    });

    $('#viewAllUserList').DataTable({
        'paging': true,
        'deferRender': true,
        'lengthChange': true,
        'searching': true,
        'info': true,
        'dom': '<"container-fluid"<"row"<"col-sm-6"B><"col-sm-4"f><"col-sm-1"l >>>rtip',
        'buttons': [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        'pageLength': 10,
        'processing': true,
        'columnDefs': [
            { "orderable": false, "targets": [ 5 , 6] }
        ],
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
            'oPaginate': oPaginate,
            'buttons': {
                copy    : copyBtn,
                csv     : csvBtn,
                excel   : excelBtn,
                pdf     : pdfBtn,
                print   : printBtn
            }
        }
    });

    $('#viewAllCustomerList').DataTable({
        'paging': true,
        'deferRender': true,
        'lengthChange': true,
        'searching': true,
        'info': true,
        'dom': '<"container-fluid"<"row"<"col-sm-6"B><"col-sm-4"f><"col-sm-1"l >>>rtip',
        'buttons': [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        'pageLength': 10,
        'processing': true,
        'columnDefs': [
            { "orderable": false, "targets": [ 5 , 6] }
        ],
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
            'oPaginate': oPaginate,
            'buttons': {
                copy    : copyBtn,
                csv     : csvBtn,
                excel   : excelBtn,
                pdf     : pdfBtn,
                print   : printBtn
            }
        }
    });

    $('#viewAllCouponList').DataTable({
        'paging': true,
        'deferRender': true,
        'lengthChange': true,
        'searching': true,
        'info': true,
        'dom': '<"container-fluid"<"row"<"col-sm-6"B><"col-sm-4"f><"col-sm-1"l >>>rtip',
        'buttons': [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        'pageLength': 10,
        'processing': true,
        'columnDefs': [
            { "orderable": false, "targets": [ 4 , 5 , 6, 7] }
        ],
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
            'oPaginate': oPaginate,
            'buttons': {
                copy    : copyBtn,
                csv     : csvBtn,
                excel   : excelBtn,
                pdf     : pdfBtn,
                print   : printBtn
            }
        }
    });

    $('#viewAllBannerList').DataTable({
        'paging': true,
        'deferRender': true,
        'lengthChange': true,
        'searching': true,
        'info': true,
        'dom': '<"container-fluid"<"row"<"col-sm-6"B><"col-sm-4"f><"col-sm-1"l >>>rtip',
        'buttons': [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        'pageLength': 10,
        'processing': true,
        'columnDefs': [
            { "orderable": false, "targets": [ 2 , 5 , 6 ] }
        ],
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
            'oPaginate': oPaginate,
            'buttons': {
                copy    : copyBtn,
                csv     : csvBtn,
                excel   : excelBtn,
                pdf     : pdfBtn,
                print   : printBtn
            }
        }
    });

    $('#viewAllFaqList').DataTable({
        'paging': true,
        'deferRender': true,
        'lengthChange': true,
        'searching': true,
        'info': true,
        'dom': '<"container-fluid"<"row"<"col-sm-6"B><"col-sm-4"f><"col-sm-1"l >>>rtip',
        'buttons': [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        'pageLength': 10,
        'processing': true,
        'columnDefs': [
            { "orderable": false, "targets": [ 3 , 4] }
        ],
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
            'oPaginate': oPaginate,
            'buttons': {
                copy    : copyBtn,
                csv     : csvBtn,
                excel   : excelBtn,
                pdf     : pdfBtn,
                print   : printBtn
            }
        }
    });
    $('#viewAllSubscribesList').DataTable({
        'paging': true,
        'deferRender': true,
        'lengthChange': true,
        'searching': true,
        'info': true,
        'dom': '<"container-fluid"<"row"<"col-sm-6"B><"col-sm-4"f><"col-sm-1"l >>>rtip',
        'buttons': [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        'pageLength': 10,
        'processing': true,
        'columnDefs': [
            { "orderable": false, "targets": [4] }
        ],
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
            'oPaginate': oPaginate,
            'buttons': {
                copy    : copyBtn,
                csv     : csvBtn,
                excel   : excelBtn,
                pdf     : pdfBtn,
                print   : printBtn
            }
        }
    });
    $('#viewAllContactUsList').DataTable({
        'paging': true,
        'deferRender': true,
        'lengthChange': true,
        'searching': true,
        'info': true,
        'dom': '<"container-fluid"<"row"<"col-sm-6"B><"col-sm-4"f><"col-sm-1"l >>>rtip',
        'buttons': [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        'pageLength': 10,
        'processing': true,
        'columnDefs': [
            { "orderable": false, "targets": [5] }
        ],
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
            'oPaginate': oPaginate,
            'buttons': {
                copy    : copyBtn,
                csv     : csvBtn,
                excel   : excelBtn,
                pdf     : pdfBtn,
                print   : printBtn
            }
        }
    });
    $('#viewAllGiftCardsList').DataTable({
        'paging': true,
        'deferRender': true,
        'lengthChange': true,
        'searching': true,
        'info': true,
        'dom': '<"container-fluid"<"row"<"col-sm-6"B><"col-sm-4"f><"col-sm-1"l >>>rtip',
        'buttons': [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        'pageLength': 10,
        'processing': true,
        'columnDefs': [
            { "orderable": false, "targets": [ 2 , 5 , 7] }
        ],
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
            'oPaginate': oPaginate,
            'buttons': {
                copy    : copyBtn,
                csv     : csvBtn,
                excel   : excelBtn,
                pdf     : pdfBtn,
                print   : printBtn
            }
        }
    });
    $('#viewAllShippingOrderList').DataTable({
        'paging': true,
        'deferRender': true,
        'lengthChange': true,
        'searching': true,
        'info': true,
        'dom': '<"container-fluid"<"row"<"col-sm-6"B><"col-sm-4"f><"col-sm-1"l >>>rtip',
        'buttons': [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        'pageLength': 10,
        'processing': true,
        'columnDefs': [
            { "orderable": false, "targets": [ 5 , 6 , 7 ] }
        ],
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
            'oPaginate': oPaginate,
            'buttons': {
                copy    : copyBtn,
                csv     : csvBtn,
                excel   : excelBtn,
                pdf     : pdfBtn,
                print   : printBtn
            }
        }
    });
    $('#viewAllCustomerOrderList').DataTable({
        'paging': true,
        'deferRender': true,
        'lengthChange': true,
        'searching': true,
        'info': true,
        'dom': '<"container-fluid"<"row"<"col-sm-6"B><"col-sm-4"f><"col-sm-1"l >>>rtip',
        'buttons': [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        'pageLength': 10,
        'processing': true,
        'columnDefs': [
            { "orderable": false, "targets": [ 4 , 5] }
        ],
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
            'oPaginate': oPaginate,
            'buttons': {
                copy    : copyBtn,
                csv     : csvBtn,
                excel   : excelBtn,
                pdf     : pdfBtn,
                print   : printBtn
            }
        }
    });
    $('#viewAllAdvertisementList').DataTable({
        'paging': true,
        'deferRender': true,
        'lengthChange': true,
        'searching': true,
        'info': true,
        "dom": '<"container-fluid"<"row"<"col-sm-5"B><"col-sm-4"f><"col-sm-1"l>>>rtip',
        'buttons': [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        'pageLength': 10,
        'processing': true,
        'columnDefs': [
            { "orderable": false, "targets": [ 2, 5 , 6 , 7 ] }
        ],
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
            'oPaginate': oPaginate,
            'buttons': {
                copy    : copyBtn,
                csv     : csvBtn,
                excel   : excelBtn,
                pdf     : pdfBtn,
                print   : printBtn
            }
        }
    });
    
    $('#viewAllMyOrderList').DataTable({
        'paging': true,
        'deferRender': true,
        'lengthChange': true,
        'searching': true,
        'info': true,
        'dom': '<"container-fluid"<"row"<"col-sm-6"B><"col-sm-4"f><"col-sm-1"l >>>rtip',
        'buttons': [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        'pageLength': 10,
        'processing': true,
        'columnDefs': [
            { "orderable": false, "targets": [ 5 , 6 , 7 ] }
        ],
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
            'oPaginate': oPaginate,
            'buttons': {
                copy    : copyBtn,
                csv     : csvBtn,
                excel   : excelBtn,
                pdf     : pdfBtn,
                print   : printBtn
            }
        }
    });
    
    $('#viewAllShipmentPickupList').DataTable({
        'paging': true,
        'deferRender': true,
        'lengthChange': true,
        'searching': true,
        'info': true,
        'dom': 'Bfrtip','dom': '<"container-fluid"<"row"<"col-sm-6"B><"col-sm-4"f><"col-sm-1"l >>>rtip',
        'buttons': [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        'pageLength': 10,
        'processing': true,
        'columnDefs': [
            { "orderable": false, "targets": [ 7 , 8 ] }
        ],
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
            'oPaginate': oPaginate,
            'buttons': {
                copy    : copyBtn,
                csv     : csvBtn,
                excel   : excelBtn,
                pdf     : pdfBtn,
                print   : printBtn
            }
        }
    });

});